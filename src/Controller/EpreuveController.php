<?php

namespace App\Controller;

use App\Entity\Epreuve;
use App\Entity\InscriptionEpreuve;
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
#[Route('/epreuve', name: 'app')]
class EpreuveController extends AbstractController
{
    #[Route('/create', name : '_create_new_epreuve')]
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
            $ueRep = $em -> getRepository(Ue::class);
            $trueNature = $natureEpreuveRep -> find($form['natureEpreuve']-> getData() -> getId());
            $trueNature -> addEpreuve($epreuve);
            $trueUe = $ueRep -> find($form['ue'] -> getData() -> getId());
            $em -> persist($epreuve);
            $em -> persist($trueNature);
            $em -> persist($trueUe);
            $em -> flush();
            return $this -> redirectToRoute('app_listing_epreuves');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/list', name : '_listing_epreuves')]
    public function listEpreuves(ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $epreuves = $em -> getRepository(Epreuve::class) -> findAll();
        $args = ['epreuves' => $epreuves];
        return  $this -> render("lists/listing_epreuves.html.twig", $args);
    }

    #[Route('/modifier/{id_epreuve}', name : '_modification')]
    public function changeEpreuve(ManagerRegistry $doc, Request $request, int $id_epreuve) {
        $em = $doc -> getManager();
        $epreuveRepository = $em -> getRepository(Epreuve::class);
        $epreuve = $epreuveRepository -> find($id_epreuve);
        if ($epreuve) {
            $form = $this -> createForm(EpreuveType::class,$epreuve);
            $form -> add("send", SubmitType::class, ['label' => "Modifier les informations de l'epreuve"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $epreuve = $form -> getData();
                $em -> persist($epreuve);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed epreuve data');
                return $this ->redirectToRoute('app_listing_epreuves');
            }
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        else
            return $this->redirectToRoute('app_listing_epreuves');
    }

    #[Route('/delete/{id_epreuve}', name : '_delete_epreuve')]
    public function deleteEpreuve(int $id_epreuve, ManagerRegistry $doc) :Response {
        $em = $doc -> getManager();
        $epreuveRepo = $em -> getRepository(Epreuve::class);
        $epreuve = $epreuveRepo -> find($id_epreuve);
        if ($epreuve) {
            $inscriptionEpreuveRepo = $em -> getRepository(InscriptionEpreuve::class);
            $inscriptionsEpreuve = $inscriptionEpreuveRepo ->findBy(['epreuve' => $epreuve -> getId()]);
            foreach ($inscriptionsEpreuve as $inscriptionEpreuve) {
                $em -> remove($inscriptionEpreuve);
            }
            $em -> remove($epreuve);
            $em -> flush();
        }
        return $this -> redirectToRoute('app_listing_epreuves');
    }
}
