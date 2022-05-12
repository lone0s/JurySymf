<?php

namespace App\Controller;

use App\Entity\Periodicite;
use App\Form\PeriodicitesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeriodicitesController extends AbstractController
{
    #[Route('/create_periodicite', name: 'app_create_periodicite')]
    public function createAction(Request $request, ManagerRegistry $doc): Response
    {
        $em = $doc -> getManager();
        $periodicite = new Periodicite();
        $form = $this -> createForm(PeriodicitesType::class,$periodicite);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $periodicite = $form -> getData();
            $em -> persist($periodicite);
            $em -> flush();
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }


}
