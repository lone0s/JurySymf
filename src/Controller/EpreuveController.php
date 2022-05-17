<?php

namespace App\Controller;

use App\Entity\Epreuve;
use App\Entity\NatureEpreuve;
use App\Entity\Ue;
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
        // Ne fonctionne pas : deal with both foreign keys
        $em = $doc -> getManager();
        $epreuve = new Epreuve();
        $form = $this -> createForm(EpreuveType::class,$epreuve);
        $form -> add("send", SubmitType::class, ['label' => "Créer l'epreuve"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $epreuve = $form -> getData();
            $natureEpreuveRep = $em -> getRepository(NatureEpreuve::class);
            $ueRep = $em -> getRepository(Ue::class);
            $natureEpreuve= $natureEpreuveRep-> findAll();
            dump($form['natureEpreuve'] -> getData());
//            foreach ($natureEpreuve as $nature) {
//                if ($nature -> getNature() == $form['natureEpreuve'] -> getData())
//                    $res = $nature;
//            }
            $trueNature = $natureEpreuveRep -> find($form['natureEpreuve']-> getData() -> getId());
            $trueNature -> addEpreuve($epreuve);
            $trueUe = $ueRep -> find($form['ue'] -> getData() -> getId());
            $em -> persist($epreuve);
            $em -> persist($trueNature);
            $em -> persist($trueUe);
            $em -> flush();
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/epreuve/list', name : 'app_listing_epreuves')]
    public function listEpreuves(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $epreuves = $em -> getRepository(Epreuve::class) -> findAll();
        $args = ['epreuves' => $epreuves];
        return  $this -> render("lists/listing_epreuves.html.twig", $args);
    }
}
