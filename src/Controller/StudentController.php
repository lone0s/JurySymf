<?php

namespace App\Controller;

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
        $studentsRepo = $em -> getRepository('App\\Entity\\Etudiant');
        $students = $studentsRepo -> findAll();
        $args = ['etudiants' => $students];
        return $this -> render("lists/listingetudiants.html.twig",$args);
    }
}
