<?php

namespace App\Controller;

use App\Entity\Mention;
use App\Form\MentionsType;
use Doctrine\Persistence\ManagerRegistry;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/mentions', name: 'mentions')]
class MentionsController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listMentions(ManagerRegistry $doc): Response
    {
        $em = $doc -> getManager();
        $mentions = $em -> getRepository(Mention::class) -> findAll();
        $args = ['mentions' => $mentions];
        return $this -> render('lists/mentions.html.twig',$args);
    }

    #[Route('/create', name: '_create')]
    public function createMentions(ManagerRegistry $doc, Request $request) : Response {
        $em = $doc -> getManager();
        $mention = new Mention();
        $form = $this -> createForm(MentionsType::class,$mention);
        $form->add("send", SubmitType::class, ['label' => "Creer la nouvelle mention"]);
        $form-> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid()) {
            $mention = $form -> getData();
            $em -> persist($mention);
            $em -> flush();
            $this -> addFlash('success', 'Successfully created mention');
            return $this -> redirectToRoute('Mentions_list');
        }
        if ($form -> isSubmitted())
            $this -> addFlash('error', 'Incorrect form data');
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/modifier/{id_mention}', name : '_change')]
    public function changeMention(int $id_mention, Request $request, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $mentionsRepo = $em -> getRepository(Mention::class);
        $mention = $mentionsRepo -> find ($id_mention);
        if ($mention) {
            $form = $this -> createForm(MentionsType::class, $mention);
            $form->add("send", SubmitType::class, ['label' => "Modifier la mention"]);
            $form -> handleRequest($request);
            if ($form -> isSubmitted() && $form -> isValid()) {
                $mention = $form -> getData();
                $em -> persist($mention);
                $em -> flush();
                $this -> addFlash('success', 'Successfully changed mention data');
                return $this -> redirectToRoute('Mentions_list');
            }
            if ($form -> isSubmitted())
                $this -> addFlash('error', 'Incorrect form data');
            $args = array("formulaire" => $form->createView());
            return $this -> render("forms/FormView.html.twig",$args);
        }
        return $this->redirectToRoute('Mentions_list');
    }

    #[Route('/supprimer/{id_mention}', name : '_delete')]
    public function deleteMention(int $id_mention, ManagerRegistry $doc) : Response {
        $em = $doc -> getManager();
        $mention = $em -> getRepository(Mention::class) -> find($id_mention);
        if (! $mention){
            throw new InvalidArgumentException('Incorrect mention id');
        }
        $em -> remove($mention);
        //Verifier que les informations sont mis a NULL quand la mention n'existe plus
        $em -> flush();
        return  $this->redirectToRoute('mentions_list');
    }
}
