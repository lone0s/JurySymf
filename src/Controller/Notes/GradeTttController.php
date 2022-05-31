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
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradeTttController extends AbstractController
{

    public function ueAverage(int $student_id, int $ue_id, ManagerRegistry $doc)
    {
        $em = $doc->getManager();
        $ueId = $em->getRepository(Ue::class)->find($ue_id);
        //On recup epreuves liées a UE
        $epreuves = $em->getRepository(Epreuve::class)->findBy([
            'ue' => $ue_id
        ]);
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
        // Gestion Remontee note + render view
        // Eventuellement utiliser form pour recup information etudiant + ue
        // Sinon automatiser pour toutes les ues ou pour chaque ajout note epreuve liée a UE
    }

    #[Route('/test/periode/{student_id}/{periode_id}', name : '_periode')]
    public function periodeAverage(int $student_id, int $periode_id, ManagerRegistry $doc){
        $em = $doc -> getManager();
        $ueRepo = $em -> getRepository(InscriptionUe::class);
        $periodesUes = $em -> getRepository(PeriodeUe::class) -> findBy([
            'periode' => $periode_id
        ]);
        $res = array();
        foreach ($periodesUes as $periodeUe) {
            $inscriptionUe = $ueRepo -> findBy([
                'etudiant' => $student_id,
                'periodeUe' => $periodeUe -> getId()
            ]);
            foreach ($inscriptionUe as $iU) {
                $res[] = $iU -> getNote();
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
            }
        }
//        dump($this->gradeType($this->average($res)));
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
    //Update : quantité colossale de data a traiter => useless (symfony ne permet pas son execution)
    //On va plutot intégrer les trois fonctions définies plus haut directement dans les fonctions d'ajout
    // et de modification de notes
/*    #[Route('/notes/update', name : '_update')]
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
    }*/

    private function getEpreuvesOfUe(int $idUe, ManagerRegistry $doc) {
        $em = $doc -> getManager();
        $epreuves = $em -> getRepository(Epreuve::class) -> findBy([
            'ue' => $idUe
        ]);
        if ($epreuves) {
            return $epreuves;
        }
        throw new InvalidArgumentException('incorrect ue id');
    }

    private function getUesOfPeriode(int $idPeriode, ManagerRegistry $doc) {
        $em = $doc -> getManager();
        $periodeUes = $em -> getRepository(PeriodeUe::class) -> findBy([
            'periode' => $idPeriode
        ]);
        $ues = [];
        foreach ($periodeUes as $periodeUe) {
            $ues[] = $periodeUe -> getUe();
        }
        if($ues) {
            return $ues;
        }
        throw new InvalidArgumentException('incorrect periode id');
    }

    private function getPeriodesOfParcour(int $idParcour, ManagerRegistry $doc) {
        $em = $doc -> getManager();
        $periodes = $em -> getRepository(Periode::class) -> findBy([
            'parcour' => $idParcour
        ]);
        if ($periodes) {
            return $periodes;
        }
        throw new InvalidArgumentException('incorrect parcours id');
    }


    #[Route('/test/calcul/{idEtudiant}/{idInscriptionUe}', name : 'test_calcul_form')]
    public function getUeGrade(int $idInscriptionUe, int $idEtudiant,ManagerRegistry $doc) : Response
    {
        //On recup les epreuves liées a l'Ue
        $em = $doc->getManager();
        $inscriptionUeRepo = $em->getRepository(InscriptionUe::class);
        $inscriptionUe = $inscriptionUeRepo->find($idInscriptionUe);
        $periodeUe = $inscriptionUe->getPeriodeUe();
        $ue = $periodeUe->getUe();
        $epreuves = $this->getEpreuvesOfUe($ue->getId(), $doc);
        $coeffs = [];
        foreach ($epreuves as $epreuve) {
            $coeffs[$epreuve->getId()] = $epreuve->getCoefficient();
        }
        $valuesArray = [];
        $coeffsArray = [];
        foreach ($coeffs as $key => $value) {
            $epreuve = $em->getRepository(InscriptionEpreuve::class)->findOneBy([
                'etudiant' => $idEtudiant,
                'periodeUe' => $periodeUe->getId(),
                'epreuve' => $key
            ]);
            $coeffsArray[] = $value;
            $valuesArray[] = $epreuve->getNote();
        }
        dump($valuesArray);
        dump($coeffsArray);
        dump($this->calculateAverage($coeffsArray, $valuesArray));
    }

    #[Route('/test/calculP/{idEtudiant}/{idInscriptionPeriode}', name : 'test_calcul_form')]
    public function getPeriodeGrade(int $idInscriptionPeriode, int $idEtudiant, ManagerRegistry $doc) : Response
    {
        $em = $doc -> getManager();
        $inscriptionPeriode = $em -> getRepository(InscriptionPeriode::class) -> find($idInscriptionPeriode);
        $ues = $this->getUesOfPeriode($inscriptionPeriode -> getPeriode() -> getId(),$doc);
        $periodeUeRepo = $em -> getRepository(PeriodeUe::class);
        $periodesUes = [];
        foreach ($ues as $ue) {
            $periodeUe = $periodeUeRepo -> findOneBy([
                'ue' => $ue -> getId(),
                'periode' => $inscriptionPeriode -> getPeriode()
            ]);
            $periodesUes[$periodeUe -> getId()] = $periodeUe;
        }
        //Manque les coeffs
        $coeffs = [];
        foreach ($periodesUes as $periodeUe) {
            $coeffs[] = $periodeUe -> getUe() -> getEcts();
        }
        //On a les periodes ues & les coeffs mtn go recup les notes via inscriptions ues

        $valuesArray = [];
        $inscriptionUeRepo = $em -> getRepository(InscriptionUe::class);
        foreach ($periodesUes as $periodeUe) {
            $note = $inscriptionUeRepo -> findOneBy([
                'etudiant' => $idEtudiant,
                'periodeUe' => $periodeUe
            ]);
            $valuesArray[] = $note -> getNote();
        }
        dump($coeffs);
        dump($valuesArray);
        dump($this->calculateAverage($coeffs,$valuesArray));
        //Okk ca marche
    }


    private function calculateAverage(array $coeffs, array $grades) : float {
        // !!! Ne prend pas en compte les points jury
        $sum = 0;
        $coeffsSum = 0;
        for($i = 0, $arraySize = count($coeffs); $i < $arraySize; $i++) {
            if ($grades[$i] === null) {
                $grades[$i] = 0;
            }
            $sum += $grades[$i] * $coeffs[$i];
            $coeffsSum += $coeffs[$i];
        }
        return ($sum/$coeffsSum);
    }
}
