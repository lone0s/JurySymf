<?php

namespace App\Controller;

use App\Entity\PeriodeUe;
use App\Entity\Ue;
use App\Form\PeriodeUeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/periode/ue', name: 'periode_ue')]
class PeriodeUeController extends AbstractController
{
    #[Route('/creer/{ueId}', name: '_create')]
    public function index(ManagerRegistry $doc, Request $request, $ueId): Response
    {
        $em = $doc -> getManager();
        $ue = $doc -> getRepository(Ue::class) -> find($ueId);
        dump($ue);
        $periodeUe = new PeriodeUe();
        $periodeUe -> setUe($ue);
        $form = $this -> createForm(PeriodeUeType::class,$periodeUe);
        $form -> add("send", SubmitType::class, ['label' => "Créer l'UE"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $periodeUe = $form -> getData();
            $em -> persist($periodeUe);
            $em -> flush();
            return $this -> redirectToRoute('ue_list');
        }
        if($form -> isSubmitted()) {
            $this -> addFlash('error', 'Incorrect data entered in form');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }
}
