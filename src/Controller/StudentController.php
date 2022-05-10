<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/StudentController.php',
        ]);
    }
    //Listing étudiants
    #[Route('/list', name: 'app_list_students')]
    public function list_students(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $studentsRepo = $em -> getRepository(Etudiant::class);
        $students = $studentsRepo -> findAll();
        $args = ['etudiants' => $students];
        return $this -> render("lists/listing_etudiants.html.twig",$args);
    }

    #[Route('/show_student/{id}', name: 'app_show_student_grades')]
    public function show_student(int $id, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $studentsRepo = $em -> getRepository(Etudiant::class);
        $student = $studentsRepo -> find($id);
        $args = ['etudiant' => $student];
        return $this -> render("lists/listing_info_etudiant.html.twig",$args);
    }


}
