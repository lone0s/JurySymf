<?php

namespace App\Controller;

use App\Entity\TypeNote;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeNoteController extends AbstractController
{
    public static function getTypesNotes(ManagerRegistry $doc) : array {
        $args = array();
        $em = $doc -> getManager();
        $typesNote= $em -> getRepository(TypeNote::class) -> findAll();
        foreach ($typesNote as $typeNote) {
            $args[$typeNote -> getId()] = $typeNote -> getType();
        }
        return $args;
    }
}
