<?php

namespace App\Controller\Notes;

use App\Entity\Epreuve;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Entity\InscriptionUe;
use App\Entity\Parcour;
use App\Entity\Periode;
use App\Entity\PeriodeUe;
use App\Entity\Ue;
use App\Form\InscriptionEpreuveCreatorType;
use App\Form\InscriptionParcoursType;
use App\Form\InscriptionParcourType;
use App\Form\InscriptionPeriodeType;
use App\Form\InscriptionUeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/notes/creer', name: 'creer_notes' )]
class GradesCreatorController extends AbstractController
{
    #[Route('/epreuve/{id_periode}/{id_ue}/{id_epreuve}', name: '_epreuve')]
    public function creerNoteEpreuve(ManagerRegistry $doc, Request $request, int $id_periode, int $id_ue, int $id_epreuve) : Response
    // Fonctionne mais !!! Pas de verification de note !!!
    {
        $em = $doc -> getManager();
        $inscriptionEpreuve = new InscriptionEpreuve();
        $periodeUeRepo = $em -> getRepository(PeriodeUe::class);
        $ue =  $em -> getRepository(Ue::class) -> find($id_ue);
        $periodeUe = $periodeUeRepo -> findOneBy([
            'periode' => $em -> getRepository(Periode::class) -> find($id_periode),
            'ue' => $ue
        ]);
        $epreuvesRepo = $em -> getRepository(Epreuve::class);
        $epreuve = $epreuvesRepo -> find($id_epreuve);
        if ($periodeUe) {
            $inscriptionEpreuve -> setPeriodeUe($periodeUe);
            $inscriptionEpreuve -> setEpreuve($epreuve);
            $form = $this->createForm(InscriptionEpreuveCreatorType::class, $inscriptionEpreuve);
            $form->add("send", SubmitType::class, ['label' => "Ajouter note epreuve"]);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $inscriptionEpreuve = $form->getData();
                $em->persist($inscriptionEpreuve);
                $em->flush();
                $this -> addFlash('success', 'Successfully created new Epreuve');
                return $this -> redirectToRoute('app_note_epreuves_etudiant', ['id' => $inscriptionEpreuve -> getEtudiant() -> getId()]);
            }
            if ($form -> isSubmitted())
                $this -> addFlash('error', 'Incorrect form data');
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        else
            return $this -> redirectToRoute('app_note_epreuves_etudiant');
    }

    #[Route('/parcours/{id_parcour}', name: '_parcours')]
    public function creerNoteParcour(ManagerRegistry $doc, Request $request, int $id_parcour) : Response
        // Fonctionne mais !!! Pas de verification de note !!!
    {
        $em = $doc->getManager();
        $inscriptionParcour = new InscriptionParcour();
        $parcour = $em -> getRepository(Parcour::class) -> find($id_parcour);
        if ($parcour)
            $inscriptionParcour -> setParcour($parcour);
        $form = $this->createForm(InscriptionParcoursType::class, $inscriptionParcour);
        $form->add("send", SubmitType::class, ['label' => "Ajouter la note du parcours"]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionParcour = $form->getData();
            $inscriptionParcour -> setSaisie(1);
            $em->persist($inscriptionParcour);
            $em->flush();
            $this->addFlash('success', 'Successfully created new note parcours');
            return $this->redirectToRoute('app_note_parcours_etudiant', ['id' => $inscriptionParcour->getEtudiant()->getId()]);
        }
        if ($form->isSubmitted())
            $this->addFlash('error', 'Incorrect form data');
        $args = array("formulaire" => $form->createView());
        return $this->render("forms/FormView.html.twig", $args);
    }

    #[Route('/periodes/{id_ue}/{id_periode}', name: '_periode')]
    public function creerNotePeriode(ManagerRegistry $doc, Request $request, int $id_periode) : Response
        // Fonctionne mais !!! Pas de verification de note !!!
    {
        $em = $doc->getManager();
        $inscriptionPeriode = new InscriptionPeriode();
        $periode = $em -> getRepository(Periode::class) -> find($id_periode);
        if ($periode)
            $inscriptionPeriode -> setPeriode($periode);
        $form = $this->createForm(InscriptionPeriodeType::class, $inscriptionPeriode);
        $form->add("send", SubmitType::class, ['label' => "Ajouter la note de la periode"]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionPeriode = $form->getData();
            $inscriptionPeriode -> setSaisie(1);
            $em->persist($inscriptionPeriode);
            $em->flush();
            $this->addFlash('success', 'Successfully created new note periode');
            return $this->redirectToRoute('app_note_periode_etudiant', ['id' => $inscriptionPeriode->getEtudiant()->getId()]);
        }
        if ($form->isSubmitted())
            $this->addFlash('error', 'Incorrect form data');
        $args = array("formulaire" => $form->createView());
        return $this->render("forms/FormView.html.twig", $args);
    }

    #[Route('/ues/{id_periode}/{id_ue}', name: '_ues')]
    public function creerNoteUe(ManagerRegistry $doc, Request $request, int $id_periode, int $id_ue) : Response
        // Fonctionne mais !!! Pas de verification de note !!!
    {
        $em = $doc->getManager();
        $inscriptionUe = new InscriptionUe();
        $periode = $em -> getRepository(Periode::class) -> find($id_periode);
        $ue = $em -> getRepository(Ue::class) -> find($id_ue);
        $periodeUe = $em -> getRepository(PeriodeUe::class) -> findOneBy([
            'periode' => $periode,
            'ue' => $ue
        ]);
        if ($periodeUe)
            $inscriptionUe -> setPeriodeUe($periodeUe);
        $form = $this->createForm(InscriptionUeType::class, $inscriptionUe);
        $form->add("send", SubmitType::class, ['label' => "Ajouter la note d'UE"]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionUe = $form->getData();
            $inscriptionUe -> setSaisie(1);
            $em->persist($inscriptionUe);
            $em->flush();
            $this->addFlash('success', 'Successfully created new note UE');
            return $this->redirectToRoute('app_list_ues', ['id' => $inscriptionUe->getEtudiant()->getId()]);
        }
        if ($form->isSubmitted())
            $this->addFlash('error', 'Incorrect form data');
        $args = array("formulaire" => $form->createView());
        return $this->render("forms/FormView.html.twig", $args);
    }
}
