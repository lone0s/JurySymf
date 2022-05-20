<?php

namespace App\Controller;

use App\Entity\TypeNote;
use App\Entity\TypeResultat;
use App\Form\TypeNoteFormType;
use App\Form\TypeResultatFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/typesResultat', name: 'typesResultat')]
class TypeResultatController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function getTypesNotes(ManagerRegistry $doc) : Response {
        $args = array();
        $em = $doc -> getManager();
        $typesResultat= $em -> getRepository(TypeResultat::class) -> findAll();
        $args = ['typesResultat' => $typesResultat];
        return $this -> render("lists/listing_types_resultat.html.twig",$args);
    }

    #[Route('/create', name: '_create')]
    public function createTypeNote(ManagerRegistry $doc, Request $request) : Response
    {
        $em = $doc->getManager();
        $typeResultat = new TypeResultat();
        $form = $this->createForm(TypeResultatFormType::class, $typeResultat);
        $form->add("send", SubmitType::class, ['label' => "Creer le nouveau type de resultats"]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $typeResultat = $form->getData();
            $em->persist($typeResultat);
            $em->flush();
            $this->addFlash('success', 'Successfully created new Type Resultat');
            return $this->redirectToRoute('typesResultat_list');
        }
        if ($form->isSubmitted())
            $this->addFlash('error', 'Incorrect form data');

        $args = array("formulaire" => $form->createView());
        return $this->render("forms/FormView.html.twig", $args);
    }


    #[Route('/modifier/{id_typeResultat}', name : '_change')]
    public function changeTypeResultat(int $id_typeResultat, Request $request, ManagerRegistry $doc) : Response{
        $em = $doc -> getManager();
        $typesResultatRepo = $em -> getRepository(TypeNote::class);
        $typeResultat = $typesResultatRepo -> find($id_typeResultat);
        if($typeResultat) {
            $form = $this -> createForm(TypeResultatFormType::class,$typeResultat);
            $form -> add("send", SubmitType::class, ['label' => "Modifier le type de resultats"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $typeResultat = $form -> getData();
                $em -> persist($typeResultat);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed type resultat');
                return $this -> redirectToRoute('typesResultat_list');
            }
            if ($form -> isSubmitted()) {
                $this->addFlash('error', 'Incorrect form data');
            }
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        else
            return $this->redirectToRoute('typesResultat_list');
    }

    #[Route('/delete/{id_typeResultat}', name : '_delete')]
    public function deleteTypeResultat(int $id_typeResultat, ManagerRegistry $doc) :Response {
        $em = $doc -> getManager();
        $typeResRepository = $em -> getRepository(TypeNote::class);
        $typeRes = $typeResRepository -> find($id_typeResultat);
        if ($typeRes) {
            $em -> remove($typeRes);
            $em -> flush();
        }
        return $this -> redirectToRoute('typesResultat_list');
    }
}
