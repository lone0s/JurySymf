<?php

namespace App\Controller;

use App\Entity\Ufr;
use App\Form\UfrType;
use Doctrine\Persistence\ManagerRegistry;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/ufrs', name: 'ufrs')]
class UfrController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function getTypesNotes(ManagerRegistry $doc) : Response {
        $args = array();
        $em = $doc -> getManager();
        $ufrs= $em -> getRepository(Ufr::class) -> findAll();
        $args = ['ufrs' => $ufrs];
        return $this -> render("lists/listing_ufrs.html.twig",$args);
    }

    #[Route('/create', name: '_create')]
    public function createTypeNote(ManagerRegistry $doc, Request $request) : Response
    {
        $em = $doc->getManager();
        $ufr = new Ufr();
        $form = $this->createForm(UfrType::class, $ufr);
        $form->add("send", SubmitType::class, ['label' => "Creer la nouvelle UFR"]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ufr = $form->getData();
            $em->persist($ufr);
            $em->flush();
            $this->addFlash('success', 'Successfully created new UFR');
            return $this->redirectToRoute('ufrs_list');
        }
        if ($form->isSubmitted()) {
            $this->addFlash('error', 'Incorrect form data');
        }
        $args = array("formulaire" => $form->createView());
        return $this->render("forms/FormView.html.twig", $args);
    }


    #[Route('/modifier/{id_ufr}', name : '_change')]
    public function changeTypeResultat(int $id_ufr, Request $request, ManagerRegistry $doc) : Response{
        $em = $doc -> getManager();
        $ufrRepo = $em -> getRepository(Ufr::class);
        $ufr = $ufrRepo -> find($id_ufr);
        if($ufr) {
            $form = $this -> createForm(UfrType::class,$ufr);
            $form -> add("send", SubmitType::class, ['label' => "Modifier l'UFR"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $ufr = $form -> getData();
                $em -> persist($ufr);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed UFR');
                return $this -> redirectToRoute('ufrs_list');
            }
            if ($form -> isSubmitted()) {
                $this->addFlash('error', 'Incorrect form data');
            }
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        throw new InvalidArgumentException('Incorrect ufr id');
    }
}
