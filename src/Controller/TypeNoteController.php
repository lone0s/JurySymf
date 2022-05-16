<?php

namespace App\Controller;

use App\Entity\TypeNote;
use App\Form\TypeNoteFormType;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/typesnote', name: 'types_note')]
class TypeNoteController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function getTypesNotes(ManagerRegistry $doc) : Response {
        $args = array();
        $em = $doc -> getManager();
        $typesNote= $em -> getRepository(TypeNote::class) -> findAll();
        $args = ['typesNote' => $typesNote];
        return $this -> render("lists/listing_types_notes.html.twig",$args);
    }

    #[Route('/create', name: '_create')]
    public function createTypeNote(ManagerRegistry $doc, Request $request) : Response {
        $em = $doc -> getManager();
        $typeNote = new TypeNote();
        $form = $this -> createForm(TypeNoteFormType::class, $typeNote);
        $form -> add("send", SubmitType::class, ['label' => "Creer le nouveau type de notes"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $typeNote = $form -> getData();
            $em -> persist($typeNote);
            $em -> flush();
            $this -> addFlash('success', 'Successfully created new Type Note');
            return $this -> redirectToRoute('types_note_list');
        }
        if ($form -> isSubmitted())
            $this -> addFlash('error', 'Incorrect form data');

        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/modifier/{id_typeNote}', name : '_change')]
    public function changeTypeNote(int $id_typeNote, Request $request, ManagerRegistry $doc) : Response{
        $em = $doc -> getManager();
        $typesNoteRepo = $em -> getRepository(TypeNote::class);
        $typeNote = $typesNoteRepo -> find($id_typeNote);
        if($typeNote) {
            $form = $this -> createForm(TypeNoteFormType::class,$typeNote);
            $form -> add("send", SubmitType::class, ['label' => "Modifier le type de notes"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $typeNote = $form -> getData();
                $em -> persist($typeNote);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed type note');
                return $this -> redirectToRoute('types_note_list');
            }
            if ($form -> isSubmitted()) {
                $this->addFlash('error', 'Incorrect form data');
            }
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        else
            return $this->redirectToRoute('types_note_list');
    }
}
