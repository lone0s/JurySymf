<?php

namespace App\Controller;

use App\Entity\Epreuve;
use App\Entity\Etudiant;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionPeriode;
use App\Entity\PeriodeUe;
use App\Entity\TypeNote;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradeManagementController extends AbstractController
{
    #[Route('/notes/epreuve/{id}', name : 'app_note_epreuves_etudiant')]
    public function listStudentTestGrades(ManagerRegistry $doc, int $id) : Response {
        $em = $doc -> getManager();
        $inscriptionEpreuveRepo = $em -> getRepository(InscriptionEpreuve::class);
        $inscriptionEpreuve = $inscriptionEpreuveRepo -> findAll();
        $inscriptionEpreuveEtudiant = array();
        foreach ($inscriptionEpreuve as $epreuve) {
            if ($id === $epreuve -> getEtudiant() -> getId()) {
                $inscriptionEpreuveEtudiant[] = $epreuve;
            }
        }
        $args = ['notes_etudiant' => $inscriptionEpreuveEtudiant];
        return $this -> render('lists/listing_notes_epreuves_etudiant.html.twig', $args);
    }
    #[Route('/notes/periode/{id}', name : 'app_note_periode_etudiant')]
    public function listStudentPeriodGrades(ManagerRegistry $doc, int $id) : Response {
        $em = $doc -> getManager();
        $inscriptionPeriodesRepo = $em -> getRepository(InscriptionPeriode::class);
        $inscriptionPeriode = $inscriptionPeriodesRepo -> findAll();
        $inscriptionPeriodeEtudiant = array();
        foreach ($inscriptionPeriode as $periode) {
            if($id === $periode -> getEtudiant() -> getId()) {
                $inscriptionPeriodeEtudiant[] = $periode;
            }
        }
        $args = ['note_periode_etudiant' => $inscriptionPeriodeEtudiant];
        return $this -> render('lists/listing_note_periode_etudiant.html.twig', $args);
    }
}
