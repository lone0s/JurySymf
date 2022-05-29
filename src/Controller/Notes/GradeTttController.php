<?php

namespace App\Controller\Notes;

use App\Entity\Epreuve;
use App\Entity\Etudiant;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Entity\InscriptionUe;
use App\Entity\Parcour;
use App\Entity\Periode;
use App\Entity\PeriodeUe;
use App\Entity\TypeNote;
use App\Entity\TypeResultat;
use App\Entity\Ue;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradeTttController extends AbstractController
{
    /*#[Route('/test/ue/{student_id}/{ue_id}', name : '_ue')]*/
    public function ueAverage(int $student_id, int $ue_id, ManagerRegistry $doc)
    {
        $em = $doc->getManager();
        $ueId = $em->getRepository(Ue::class)->find($ue_id);
        //On recup epreuves liées a UE
        $epreuves = $em->getRepository(Epreuve::class)->findBy([
            'ue' => $ue_id
        ]);
        dump($epreuves);
        //On recup les notes de l'étudiant aux épreuves en question
        $inscriptionEpreuveRepo = $em->getRepository(InscriptionEpreuve::class);
        $res = array();
        foreach ($epreuves as $epreuve) {
            $inscriptionEpreuve = $inscriptionEpreuveRepo->findBy([
                'etudiant' => $student_id,
                'epreuve' => $epreuve->getId()
            ]);
            foreach ($inscriptionEpreuve as $ie) {
                $res[] = $ie->getNote();
            }
        }
        dump($this->average($res));
        // Gestion Remontee note + render view
        // Eventuellement utiliser form pour recup information etudiant + ue
        // Sinon automatiser pour toutes les ues ou pour chaque ajout note epreuve liée a UE
    }

    /*#[Route('/test/periode/{student_id}/{periode_id}', name : '_periode')]*/
    public function periodeAverage(int $student_id, int $periode_id, ManagerRegistry $doc){
        $em = $doc -> getManager();
        $ueRepo = $em -> getRepository(InscriptionUe::class);
        $periodes = $em -> getRepository(PeriodeUe::class) -> findBy([
            'periode' => $periode_id
        ]);
        dump($periodes);
        $res = array();
        foreach ($periodes as $periode) {
            dump($periode);
            $inscriptionUe = $ueRepo -> findBy([
                'etudiant' => $student_id,
                'periodeUe' => $periode -> getId()
            ]);
            foreach ($inscriptionUe as $iU) {
                $res[] = $iU -> getNote();
                dump($iU -> getNote());
            }
        }
/*        $avg[] = $this->average($res);
        $args = ['notes' => $avg];
        return  $this -> render('lists/notes/test.html.twig', $args);*/
        //Marche
    }

    /*#[Route('/test/parcours/{student_id}/{parcour_id}', name: '_parcours')]*/
    public function parcoursAverage(int $student_id, int $parcour_id, ManagerRegistry $doc) {
        //Pour parcours ==> legerement diff
        //Recup les périodes liées a Parcours via table Periode
        //Recup les notes dans inscription parcours et faire moyenne
        $em = $doc -> getManager();
        $periodeRepo = $em -> getRepository(InscriptionPeriode::class);
        $periodes = $em -> getRepository(Periode::class) -> findBy([
            'parcour' => $parcour_id
        ]);
        dump($periodes);
        $res = array();
        foreach ($periodes as $periode) {
            $inscriptionPeriode = $periodeRepo -> findBy([
                'etudiant' => $student_id,
                'periode' => $periode -> getId()
            ]);
            foreach ($inscriptionPeriode as $iP) {
                $res[] = $iP -> getNote();
                dump($iP -> getNote());
            }
        }
        dump($this->gradeType($this->average($res)));
    }

    private function gradeType(int $grade) {
        return match (true) {
            $grade < 10 => 'ADMIS',
            $grade < 12 => 'PASSABLE',
            $grade < 14 => 'ASSEZ BIEN',
            $grade < 16 => 'BIEN',
            $grade <= 20 => 'TRES BIEN',
            default => 'DEFAILLANT',
        };
    }

    private function average(array $grades) {
        $cpt = 0;
        $sum = 0;
        foreach ($grades as $grade) {
            $sum += $grade;
            $cpt ++;
        }
        if ($cpt != 0 )
            return ($sum / $cpt);
        else
            return 0;
    }

    //Fonction utile si on veut tout update après multiples modifications mais complexité catastrophique
    #[Route('/notes/update', name : '_update')]
    public function updateGradesAverage(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $students = $em -> getRepository(Etudiant::class) -> findAll();
        foreach ($students as $student) {
            $studentId = $student -> getId();
            $studentInsPar = $em -> getRepository(InscriptionParcour::class) -> findBy([
                'etudiant' => $studentId
            ]);
            $studentInsPer = $em -> getRepository(InscriptionPeriode::class) -> findBy([
                'etudiant' => $studentId
            ]);
            $studentInsUe = $em -> getRepository(InscriptionEpreuve::class) -> findBy([
                'etudiant' => $studentId
            ]);
            foreach ($studentInsPar as $sIPa) {
                $this->parcoursAverage(
                    $studentId,
                    $sIPa -> getParcour() ->getId(),
                    $doc
                ) ;
            }
            foreach ($studentInsPer as $sIPe) {
                $this -> periodeAverage(
                    $studentId,
                    $sIPe -> getId(),
                    $doc
                );
            }
            foreach ($studentInsUe as $sUe) {
                $ueId = $sUe -> getPeriodeUe() -> getUe() -> getId();
                $this -> ueAverage(
                    $studentId,
                    $ueId,
                    $doc
                );
            }
        }
        return $this -> redirectToRoute('app_index');
    }

}
