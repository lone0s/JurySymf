<?php

namespace App\Controller;

use App\Entity\Parcour;
use App\Entity\Periodicite;
use App\Form\ParcoursType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcoursController extends AbstractController
{
    #[Route('/parcours/create', name: 'app_create_parcours')]
    public function createParcours(Request $request, ManagerRegistry $doc): Response
    {
        $em = $doc -> getManager();
        $parcours = new Parcour();
        $form = $this -> createForm(ParcoursType::class,$parcours);
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $parcours = $form -> getData();
            $em -> persist($parcours);
            $em -> flush();
            $this -> addFlash('success', 'successfully created new Parcours');
            return $this -> redirectToRoute('app_list_parcours');
        }
        if ($form -> isSubmitted()) {
            $this -> addFlash('error', 'invalid form data');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }


    #[Route('/parcours/change/{id_parcours}', name: 'app_change_parcours')]
    public function changeParcours(int $id_parcours, Request $request, ManagerRegistry $doc) : Response
    {
        $em = $doc -> getManager();
        $parcours = $em -> getRepository(Parcour::class) -> find($id_parcours);
        if (! $parcours) {
            $this -> createAccessDeniedException('You do not have access to this');
        }
        $form = $this -> createForm(ParcoursType::class,$parcours);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $parcours = $form -> getData();
            $em -> persist($parcours);
            $em -> flush();
            $this -> addFlash('success', 'successfully modified Parcours');
            return $this -> redirectToRoute('app_list_parcours');
        }
        if($form -> isSubmitted())
        {
            $this -> addFlash('error', 'Invalid parcours form data');
        }
        $args = ['formulaire'=>$form -> createView()];
        return  $this -> render("forms/FormView.html.twig", $args);
    }

    #[Route('/parcours/list', name: 'app_list_parcours')]
    public function listParcours(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $parcours = $em -> getRepository(Parcour::class) -> findAll();
        $args = ['parcours' => $parcours];
        return $this -> render('/lists/listing_parcours.html.twig',$args);
    }
}
