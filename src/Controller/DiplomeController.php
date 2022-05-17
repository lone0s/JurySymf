<?php

namespace App\Controller;

use App\Entity\Diplome;
use App\Form\DiplomeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/diplomes', name: 'diplomes')]
class DiplomeController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function list_diplomes(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $diplomesRepo = $em -> getRepository(Diplome::class);
        $diplomes = $diplomesRepo -> findAll();
        $args = ['diplomes' => $diplomes];
        return $this -> render("lists/listing_diplomes.html.twig",$args);
    }

    #[Route('/add', name : '_add_diplome')]
    public function addDiplome(ManagerRegistry $doc, Request $request) : Response {
        $em = $doc -> getManager();
        $diplome = new Diplome();
        $form = $this -> createForm(DiplomeType::class, $diplome);
        $form -> add("send", SubmitType::class, ['label' => "Ajouter le diplome"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $diplome = $form -> getData();
            $em -> persist($diplome);
            $em -> flush();
            $this -> addFlash('success', 'Successfully added new diplome to database');
            return $this -> redirectToRoute('diplomes_list');
        }
        if ($form -> isSubmitted()) {
            $this -> addFlash('error', 'Incorrect form data');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/modifierInformations/{id_diplome}', name : '_change')]
    public function changeDiplome(int $id_diplome, Request $request, ManagerRegistry $doc) {
        $em = $doc -> getManager();
        $diplomeRepository = $em -> getRepository(Diplome::class);
        $diplome = $diplomeRepository -> find($id_diplome);
        if ($diplome) {
            $form = $this -> createForm(DiplomeType::class,$diplome);
            $form -> add("send", SubmitType::class, ['label' => "Modifier les informations du diplome"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $diplome = $form -> getData();
                $em -> persist($diplome);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed diplome data');
                return $this ->redirectToRoute('diplomes_list');
            }
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        else
            return $this->redirectToRoute('diplomes_list');
    }
}
