<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        return $this -> render("lists/listing_etudiants.html.twig",$args);
    }

    #[Route('/{id}', name: '_show_student_grades')]
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
}
