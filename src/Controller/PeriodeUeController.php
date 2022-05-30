<?php

namespace App\Controller;

use App\Entity\PeriodeUe;
use App\Form\PeriodeUeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/periode/ue', name: 'periode_ue')]
class PeriodeUeController extends AbstractController
{
    #[Route('/test', name: '_test')]
    public function index(ManagerRegistry $doc, Request $request): Response
    {
        $em = $doc -> getManager();
        $parcoursRepo = $doc -> getRepository(PeriodeUe::class);
        $form = $this -> createForm(PeriodeUeType::class);
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }
}
