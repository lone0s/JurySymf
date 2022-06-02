<?php

namespace App\Controller;

use App\Entity\Parcour;
use App\Entity\Periode;
use App\Form\ParcoursType;
use App\Form\PeriodeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
#[Route('/periode', name: 'periode')]
class PeriodeController extends AbstractController
{
    #[Route('/create', name: '_create')]
    public function createPeriod(ManagerRegistry $doc, Request $request): Response
    {
        $em = $doc -> getManager();
        $newPeriode = new Periode();
        $form = $this -> createForm(PeriodeType::class,$newPeriode);
        $form -> add("send", SubmitType::class, ['label' => "Créer le parcours"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $newPeriode = $form -> getData();
            $em -> persist($newPeriode);
            $em -> flush();
            $this -> addFlash('success', 'Successfully created new Periode');
            return  $this -> redirectToRoute('periode_list');
        }
        if($form -> isSubmitted()) {
            $this -> addFlash('success', 'Incorrect form data');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }
    #[Route('/list', name: '_list')]
    public function listPeriodes(ManagerRegistry $doc): Response  {
        $em = $doc -> getManager();
        $periodes = $em -> getRepository(Periode::class) -> findAll();
        $args = ['periodes' => $periodes];
        return  $this -> render('lists/listing_periodes.html.twig', $args);
    }
    #[Route('/change/{id_periode}', name: '_change')]
    public function changeParcours(ManagerRegistry $doc, Request $request, int $id_periode) : Response {
        $em = $doc -> getManager();
        $periodeRepo = $doc -> getRepository(Periode::class);
        $periode = $periodeRepo -> find($id_periode);
        dump($periode);
        if ($periode) {
            $form = $this -> createForm(PeriodeType::class,$periode);
            $form -> add("send", SubmitType::class, ['label' => "Modifier la période universitaire"]);
            $form -> handleRequest($request);
            if($form -> isSubmitted() && $form -> isValid()) {
                $periode = $form -> getData();
                $em -> persist($periode);
                $em -> flush();
                $this -> addFlash('success', 'Successfully modified Periode');
                return  $this -> redirectToRoute('periode_list');
            }
            if($form -> isSubmitted()) {
                $this -> addFlash('error', 'Incorrect form data');
            }
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        throw new InvalidArgumentException('Incorrect periode id');
    }
}
