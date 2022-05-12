<?php

namespace App\Controller;

use App\Entity\Ue;
use App\Form\UeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception;

class UeController extends AbstractController
{
    #[Route('/ues/create', name:'app_create_ue')]
    public function createUe(ManagerRegistry $doc, Request $request) : Response
    {
        $em = $doc -> getManager();
        $ue = new Ue();
        $form = $this -> createForm(UeType::class,$ue);
        $form -> add("send", SubmitType::class, ['label' => "Créer l'UE"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $ue = $form -> getData();
            $em -> persist($ue);
            $em -> flush();
            $this -> addFlash('success', 'successfully created new Ue');
            return $this->redirectToRoute('app_list_ues');
        }
        if ($form -> isSubmitted()) {
            $this -> addFlash('error', 'Incorrect data entered in form');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/ues/change/{ue_id}', name: 'app_change_ue_info')]
    public function changeUeData( ManagerRegistry $doc, Request $request, int $ue_id) : Response
    {
        $em = $doc->getManager();
        $ue = $em->getRepository(Ue::class)->find($ue_id);
        if ($ue && $ue -> getCommentaire() === null) {
            $ue -> setCommentaire('');
        }
        $form = $this->createForm(UeType::class, $ue);
        $form->add("send", SubmitType::class, ['label' => "Modifier l'UE"]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ue = $form->getData();
            $em->persist($ue);
            $em->flush();
            $this->addFlash('success', 'successfully modifie new Ue');
            return $this->redirectToRoute('app_list_ues');
        }
        if ($form->isSubmitted()) {
            $this -> addFlash('error', 'Incorrect data entered in form');
        }
        else {
            $this -> createNotFoundException("UE id doesn't exist");
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/ues/list', name : 'app_list_ues')]
    public function listUes(ManagerRegistry $doc) : Response
    {
        $em = $doc -> getManager();
        $ues = $em -> getRepository(Ue::class) -> findAll();
        $args = ['ues' => $ues];
        return $this -> render('/lists/listing_ues.html.twig', $args);
    }
}
