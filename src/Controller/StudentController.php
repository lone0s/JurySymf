<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Entity\InscriptionUe;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/etudiants", name: 'etudiants')]
class StudentController extends AbstractController
{
    //Listing étudiants
    #[Route('/list', name: '_list')]
    public function list_students(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $studentsRepo = $em -> getRepository(Etudiant::class);
        $students = $studentsRepo -> findAll();
        $args = ['etudiants' => $students];
        return $this -> render("lists/listing_info_etudiant.html.twig",$args);
    }

    #[Route('/specific/{id}', name: '_show_student_grades')]
    public function show_student(int $id, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $studentsRepo = $em -> getRepository(Etudiant::class);
        $student = $studentsRepo -> find($id);
        $args = ['etudiant' => $student];
        return $this -> render("lists/listing_info_etudiant.html.twig",$args);
    }

    #[Route('/add', name : '_add_student')]
    public function addStudent(ManagerRegistry $doc, Request $request) : Response {
        $em = $doc -> getManager();
        $student = new Etudiant();
        $form = $this -> createForm(StudentType::class, $student);
        $form -> add("send", SubmitType::class, ['label' => "Ajouter l'étudiant"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $student = $form -> getData();
            $em -> persist($student);
            $em -> flush();
            $this -> addFlash('succes', 'Successfully added new student to database');
            return $this -> redirectToRoute('etudiants_list');
        }
        if ($form -> isSubmitted()) {
            $this -> addFlash('error', 'Incorrect form data');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/modifierInformations/{id_student}', name : '_change')]
    public function changeStudent(int $id_student, Request $request, ManagerRegistry $doc) {
        $em = $doc -> getManager();
        $studentRepo = $em -> getRepository(Etudiant::class);
        $student = $studentRepo -> find($id_student);
        if ($student) {
            $form = $this -> createForm(StudentType::class,$student);
            $form -> add("send", SubmitType::class, ['label' => "Modifier les informations de l'étudiant"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $student = $form -> getData();
                $em -> persist($student);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed student data');
                return $this ->redirectToRoute('etudiants_list');
            }
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        else
            return $this->redirectToRoute('etudiants_list');
    }

    #[Route('/supprimer/{id_etudiant}', name : '_delete')]
    public function deleteEtudiant(int $id_etudiant, ManagerRegistry $doc) :Response {
        $em = $doc -> getManager();
        $etudiantRepo = $em -> getRepository(Etudiant::class);
        //Recuperation de chacun des repos ou un étudiant existe
        $etudiantDataRepos["inscription_epreuves"] = $em -> getRepository(InscriptionEpreuve::class);
        $etudiantDataRepos["inscription_parcours"] = $em -> getRepository(InscriptionParcour::class);
        $etudiantDataRepos["inscription_periodes"] = $em -> getRepository(InscriptionPeriode::class);
        $etudiantDataRepos["inscription_ues"] = $em -> getRepository(InscriptionUe::class);
        $etudiant = $etudiantRepo -> find($id_etudiant);
        $etudiantResults = array();
        if ($etudiant) {
            // On recupere les résultats
            foreach ($etudiantDataRepos as $inscriptionEtudiant) {
                $etudiantResults[] = $inscriptionEtudiant -> findBy(['etudiant' => $id_etudiant]);
            }
            //Suppression de chacun des éléments liés a l'étudiant (il s'agit d'un tableau de tableau)
            foreach ($etudiantResults as $results => $innerArray) {
                foreach ($innerArray as $innerRes => $res) {
                    $em -> remove($res);
                }
            }
            $em -> remove($etudiant);
            $em -> flush();
        }
        dump($etudiantResults);
        return $this -> redirectToRoute('etudiants_list');
    }
/*
    #[Route('/notes/{id_etudiant}' , name : '_notes_specific')]
    public function studentGrades(int $id_etudiant, ManagerRegistry $doc) : Response
    //Eventuellement pour récuperer les notes aux ues, au parcour, a la periode et aux épreuves d'un étudiant?
    {
    }*/
}
