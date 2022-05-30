<?php

namespace App\Controller\Notes;

use App\Entity\Epreuve;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Entity\InscriptionUe;
use App\Entity\Periode;
use App\Entity\PeriodeUe;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
#[Route('/supprimer/notes', name: 'supprimer')]
class GradesDeletersController extends AbstractController
{
    private function supprimerNoteEpreuve(InscriptionEpreuve $inscriptionEpreuve, ManagerRegistry $doc) : void {
        $em = $doc -> getManager();
        $em -> remove($inscriptionEpreuve);
    }

    private function supprimerNoteUe(InscriptionUe $inscriptionUe, ManagerRegistry $doc) : void {
        $em = $doc -> getManager();
        $student = $inscriptionUe -> getEtudiant() -> getId();
        $periodeUe = $inscriptionUe -> getPeriodeUe() ;
        $inscriptionsEpreuve = $em -> getRepository(InscriptionEpreuve::class) -> findBy([
            'periodeUe' => $periodeUe,
            'etudiant' => $student
        ]);
        foreach ($inscriptionsEpreuve as $inscriptionEpreuve) {
            $this->supprimerNoteEpreuve($inscriptionEpreuve,$doc);
        }
        $em -> remove($inscriptionUe);
    }

    private function supprimerNotePeriode(InscriptionPeriode $inscriptionPeriode, ManagerRegistry $doc) : void {
        $em = $doc -> getManager();
        $student = $inscriptionPeriode -> getEtudiant() -> getId();
        $periode = $inscriptionPeriode -> getPeriode();
        $periodeUe = $em -> getRepository(PeriodeUe::class) -> findBy([
            'periode' => $periode
        ]);
        foreach ($periodeUe as $pU) {
            $inscriptionUe = $em -> getRepository(InscriptionUe::class) -> findBy([
                'etudiant' => $student,
                'periodeUe' => $pU
            ]);
            foreach ($inscriptionUe as $iU) {
                $this->supprimerNoteUe($iU,$doc);
            }
        }
        $em -> remove($inscriptionPeriode);
    }

    private function supprimerNoteParcour(InscriptionParcour $inscriptionParcour, ManagerRegistry $doc) : void {
        $em = $doc -> getManager();
        $student = $inscriptionParcour -> getEtudiant() -> getId();
        $parcour = $inscriptionParcour -> getParcour() -> getId();
        $periodes = $em -> getRepository(Periode::class) -> findBy([
            'parcour' => $parcour
        ]);
        foreach ($periodes as $periode) {
            $inscriptionPeriode = $em -> getRepository(InscriptionPeriode::class) -> findBy([
                'etudiant' => $student,
                'periode' => $periode
            ]);
            foreach ($inscriptionPeriode as $iP) {
                $this->supprimerNotePeriode($iP,$doc);
            }
        }
        $em -> remove($inscriptionParcour);
    }


    #[Route('/epreuves/{inscriptionEpreuveId}', name : '_epreuve_grade')]
    public function deleteEpreuveGrade(int $inscriptionEpreuveId, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $inscriptionEpreuve = $em -> getRepository(InscriptionEpreuve::class) -> find($inscriptionEpreuveId);
        if (!$inscriptionEpreuve) {
            throw new InvalidArgumentException('Incorrect Inscription Epreuve Id');
        }
        $this->supprimerNoteEpreuve($inscriptionEpreuve,$doc);
        $em -> flush();
        return $this -> redirectToRoute('_epreuves_list');
    }
    #[Route('/ues/{inscriptionUeId}', name : '_epreuve_grade')]
    public function deleteUeGrade(int $inscriptionUeId, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $inscriptionUe = $em -> getRepository(InscriptionUe::class) -> find($inscriptionUeId);
        if(!$inscriptionUe) {
            throw new InvalidArgumentException('Incorrect inscriptionUe id');
        }
        $this->supprimerNoteUe($inscriptionUe,$doc);
        $em -> flush();
        return $this -> redirectToRoute('_ues_list');
    }
    #[Route('/periode/{inscriptionPeriodeId}', name : '_epreuve_grade')]
    public function deletePeriodeGrade(int $inscriptionPeriodeId, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $inscriptionPeriode = $em -> getRepository(InscriptionPeriode::class) -> find($inscriptionPeriodeId);
        if (!$inscriptionPeriode) {
            throw new InvalidArgumentException('Incorrect Inscription Epreuve Id');
        }
        $this->supprimerNotePeriode($inscriptionPeriode,$doc);
        $em -> flush();
        return $this -> redirectToRoute('_periodes_list');
    }
    #[Route('/parcour/{inscriptionParcourId}', name : '_epreuve_grade')]
    public function deleteParcourGrade(int $inscriptionParcourId, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $inscriptionParcour = $em -> getRepository(InscriptionParcour::class) -> find($inscriptionParcourId);
        if (!$inscriptionParcour) {
            throw new InvalidArgumentException('Incorrect Inscription Epreuve Id');
        }
        $this->supprimerNoteParcour($inscriptionParcour,$doc);
        $em -> flush();
        return $this -> redirectToRoute('_parcours_list');
    }
}
