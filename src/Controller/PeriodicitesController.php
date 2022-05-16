<?php

namespace App\Controller;

use App\Entity\Periodicite;
use App\Form\PeriodicitesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/periodicite', name : 'periodicite')]
class PeriodicitesController extends AbstractController
{
    #[Route('/create', name: '_create')]
    public function createAction(Request $request, ManagerRegistry $doc): Response
    {
        $em = $doc -> getManager();
        $periodicite = new Periodicite();
        $form = $this -> createForm(PeriodicitesType::class,$periodicite);
        $form -> add("send", SubmitType::class, ['label' => "Créer la périodicité"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $periodicite = $form -> getData();
            $em -> persist($periodicite);
            $em -> flush();
            $this -> addFlash('success', 'Successfully created new periodicité');
            return  $this -> redirectToRoute('periodicite_list');
        }
        if($form -> isSubmitted())
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/list', name : '_list')]
    public function listPeriodicites(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $periodicites = $em -> getRepository(Periodicite::class);
        $args = ['periodicites' => $periodicites];
        return $this -> render('lists/listing_periodicites.html.twig', $args);
    }

    #[Route('/change/{id_periodicite}', name : '_change')]
    public function changePeriodicite(int $id_periodicite, ManagerRegistry $doc, Request $request) : Response {
        $em = $doc -> getManager();
        $periodiciteRepo = $em -> getRepository(Periodicite::class);
        $periodicite = $periodiciteRepo-> find($id_periodicite);
        if ($periodicite) {
            $form = $this -> createForm(PeriodicitesType::class,$periodicite);
            $form -> add("send", SubmitType::class, ['label' => "Modifier la périodicité"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $periodicite = $form -> getData();
                $em -> persist($periodicite);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed periodicite');
                return $this -> redirectToRoute('periodicite_list');
            }
            if($form -> isSubmitted()) {
                $this -> addFlash('error','Incorrect form data');
            }
        }
        else {
            return $this -> redirectToRoute('periodicite_list');
        }
    }
}
