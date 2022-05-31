<?php

namespace App\Controller\Notes;

use App\Controller\TypeNoteController;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Entity\InscriptionUe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function dump;

class GradesListingController extends AbstractController
{
    #[Route('/notes/epreuves/{id}', name : 'app_note_epreuves_etudiant')]
    public function listStudentTestGrades(ManagerRegistry $doc, int $id) : Response {
        $em = $doc -> getManager();
        $inscriptionEpreuveRepo = $em -> getRepository(InscriptionEpreuve::class);
        $inscriptionEpreuveEtudiant = $inscriptionEpreuveRepo -> findBy([
            'etudiant' => $id
        ]);
        $args = ['notes_etudiant' => $inscriptionEpreuveEtudiant];
        return $this -> render('lists/Inscriptions/listing_notes_epreuves_etudiant.html.twig', $args);
    }
    #[Route('/notes/periodes/{id}', name : 'app_note_periode_etudiant')]
    public function listStudentPeriodGrades(ManagerRegistry $doc, int $id) : Response {
        $em = $doc -> getManager();
        $inscriptionPeriodesRepo = $em -> getRepository(InscriptionPeriode::class);
        $inscriptionPeriodeEtudiant = $inscriptionPeriodesRepo -> findBy([
            'etudiant' => $id
        ]);
        $args = ['note_periode_etudiant' => $inscriptionPeriodeEtudiant];
        return $this -> render('lists/Inscriptions/listing_note_periode_etudiant.html.twig', $args);
    }
    #[Route('/notes/parcours/{id}', name: 'app_note_parcours_etudiant')]
    public function listStudentParcoursGrades(ManagerRegistry $doc, int $id) : Response {
        $em = $doc -> getManager();
        $inscriptionParcoursRepo = $em -> getRepository(InscriptionParcour::class);
        $inscriptionParcoursEtudiant = $inscriptionParcoursRepo -> findBy([
            'etudiant' => $id
        ]);
        $args = ['note_parcours_etudiant' => $inscriptionParcoursEtudiant];
        return $this -> render('lists/Inscriptions/listing_note_parcours_etudiant.html.twig', $args);
    }

    #[Route('/notes/ues/{id}', name: 'app_note_ues_etudiant')]
    public function listStudentUeGrades(ManagerRegistry $doc, int $id) : Response {
        $em = $doc -> getManager();
        $inscriptionUesRepo = $em -> getRepository(InscriptionUe::class);
        $inscriptionUesEtudiant = $inscriptionUesRepo -> findBy([
            'etudiant' => $id
        ]);
        $args = ['notes_ues_etudiant' => $inscriptionUesEtudiant];
        return $this -> render('lists/Inscriptions/listing_notes_ues_etudiant.html.twig', $args);
    }

    #[Route('/notes/parcours', name: '_parcours_list')]
    public function listStudentsParcoursGrades(ManagerRegistry $doc) :Response {
        $em = $doc -> getManager();
        $inscriptionParcours = $em -> getRepository(InscriptionParcour::class) -> findAll();
        $args = ['note_parcours_etudiant' => $inscriptionParcours];
        return $this -> render('lists/Inscriptions/listing_note_parcours_etudiant.html.twig', $args);
    }


    #[Route('/notes/periodes', name: '_periodes_list')]
    public function listStudentsPeriodesGrades(ManagerRegistry $doc) :Response {
        $em = $doc -> getManager();
        $inscriptionsPeriodes = $em -> getRepository(InscriptionPeriode::class) -> findAll();
        $args = ['note_periode_etudiant' => $inscriptionsPeriodes];
        return $this -> render('lists/Inscriptions/listing_note_periode_etudiant.html.twig', $args);
    }


    #[Route('/notes/epreuves', name: '_epreuves_list')]
    public function listStudentsEpreuvesGrades(ManagerRegistry $doc) :Response {
        $em = $doc -> getManager();
        $inscriptionEpreuves = $em -> getRepository(InscriptionEpreuve::class) -> findAll();
        $args = ['notes_etudiant' => $inscriptionEpreuves];
        return $this -> render('lists/Inscriptions/listing_notes_epreuves_etudiant.html.twig', $args);
    }


    #[Route('/notes/ues', name: '_ues_list')]
    public function listStudentsUesGrades(ManagerRegistry $doc) :Response {
        $em = $doc -> getManager();
        $inscriptionsUes = $em -> getRepository(InscriptionUe::class) -> findAll();
        $args = ['notes_ues_etudiant' => $inscriptionsUes];
        return $this -> render('lists/Inscriptions/listing_notes_ues_etudiant.html.twig', $args);
    }


}
