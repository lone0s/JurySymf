<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('', name : 'redirect')]
class FrontEndController extends AbstractController
{
    #[Route('/notes',name : '_to_notes_view')]
    public function redirectToGrades() : Response {
        return $this -> render('site/links/notes/grades_links.html.twig');
    }

    #[Route('/gestion', name : '_to_gestion_view')]
    public function redirectToGestion() : Response {
        return  $this -> render('site/links/gestion.html.twig');
    }

    #[Route('/univ' , name : '_to_gestion_universitaire')]
    public function redirectToGUniv() : Response {
        return  $this -> render('site/links/universite/main_univ_links.html.twig');
    }
/*
    #[Route('/diplomes', name: '_to_diplomes')]
    public function redirectToDiplomes : Response {
        return $this -> render('')
    }*/

}
