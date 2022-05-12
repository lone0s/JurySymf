<?php

namespace App\Controller;

use App\Entity\Epreuve;
use App\Entity\NatureEpreuve;
use App\Form\EpreuveType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EpreuveController extends AbstractController
{
    #[Route('/epreuve/create', name : 'app_create_new_epreuve')]
    public function create_epreuve(ManagerRegistry $doc, Request $request) : Response {
        $em = $doc -> getManager();
        $epreuve = new Epreuve();
        $form = $this -> createForm(EpreuveType::class,$epreuve);
        $form -> add("send", SubmitType::class, ['label' => "Créer l'epreuve"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $epreuve = $form -> getData();
            $natureEpreuveRep = $em -> getRepository(NatureEpreuve::class);
            $natureEpreuve= $natureEpreuveRep-> findAll();
            $res = null;
            foreach ($natureEpreuve as $nature) {
                $res = $nature -> getIdFromName($form['nature']);
            }
            $trueNature = $natureEpreuveRep -> find($res);
            $trueNature -> setEpreuve($epreuve);
            $em -> persist($epreuve);
            $em -> persist($trueNature);
            $em -> flush();
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }
}
