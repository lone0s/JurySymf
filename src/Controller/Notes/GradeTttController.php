<?php

namespace App\Controller\Notes;

use App\Entity\Etudiant;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GradeTttController extends AbstractController
{
    public function ueAverage(int $student_id, ManagerRegistry $doc) {
/*        $em = $doc -> getManager();
        $student = $em -> getRepository(Etudiant::class) -> find($student_id);
        $res['etudiant'] = $student;
        */
    }
}
