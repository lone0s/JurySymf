<?php

namespace App\Controller;

use App\Entity\NatureEpreuve;
use App\Form\NatureEpreuveType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/naturesepreuves', name: 'natures_epreuves')]
class NatureEpreuveController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listNaturesEpreuves(ManagerRegistry $doc): Response
    {
        $em = $doc -> getManager();
        $naturesEpreuves = $em -> getRepository(NatureEpreuve::class) -> findAll();
        $args = ['naturesEpreuves' => $naturesEpreuves];
        return  $this -> render('lists/natures_epreuves.html.twig', $args);
    }

    #[Route('/creer', name: '_create')]
    public function createNatureEpreuve(ManagerRegistry $doc, Request $request) : Response {
        $em = $doc -> getManager();
        $natureEpreuve = new NatureEpreuve();
        $form = $this -> createForm(NatureEpreuveType::class,$natureEpreuve);
        $form->add("send", SubmitType::class, ['label' => "Creer la nouvelle nature d'épreuve"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $natureEpreuve = $form -> getData();
            $em -> persist($natureEpreuve);
            $em -> flush();
            $this -> addFlash('success', 'Successfully created nature epreuve');
            return $this -> redirectToRoute('natures_epreuves_list');
        }
        if ($form -> isSubmitted())
            $this -> addFlash('error', 'Incorrect form data');
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/modifier/{id_natureEpreuve}', name : '_change')]
    public function changeMention(int $id_natureEpreuve, Request $request, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $natureEpreuveRepo = $em -> getRepository(NatureEpreuve::class);
        $natureEpreuve = $natureEpreuveRepo -> find ($id_natureEpreuve);
        if ($natureEpreuve) {
            $form = $this -> createForm(NatureEpreuveType::class, $natureEpreuve);
            $form->add("send", SubmitType::class, ['label' => "Modifier la nature d'épreuve"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $natureEpreuve = $form -> getData();
                $em -> persist($natureEpreuve);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed nature epreuve');
                return $this -> redirectToRoute('natures_epreuves_list');
            }
            if ($form -> isSubmitted())
                $this -> addFlash('error', 'Incorrect form data');
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        else
            return $this -> redirectToRoute('natures_epreuves_list');
    }

    //Pas besoin de delete ???
}
