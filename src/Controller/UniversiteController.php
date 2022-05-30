<?php

namespace App\Controller;

use App\Entity\Universite;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/universite', name: 'universite')]
class UniversiteController extends AbstractController
{
    #[Route('', name: '_list')]
    public function index(ManagerRegistry $doc): Response
    {
        $em = $doc -> getManager();
        $args = ['univs' => $em -> getRepository(Universite::class) -> findAll()];
        return $this -> render('/lists/listing_universites.html.twig', $args);
    }
}
