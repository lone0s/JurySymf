<?php

namespace App\Controller\Notes;

use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Form\EditTestGradeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradesModificationController extends AbstractController
{
    #[Route('/grades/test/modification/{student_id}/{epreuve_id}', name: 'app_epreuve_grade_modification')]
    public function changeStudentTestGrade(ManagerRegistry $doc, int $student_id, int $epreuve_id, Request $request) : Response
    {
        $em = $doc -> getManager();
        $form = $this -> createForm(EditTestGradeType::class);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $grade = $form['note'] -> getData();
            dump($grade);
            $inscriptionsEpreuve = $em -> getRepository(InscriptionEpreuve::class) -> findAll();
            foreach ($inscriptionsEpreuve as $epreuve)
            {
                if ($epreuve->getEpreuve()-> getId() === $epreuve_id && $epreuve->getEtudiant()-> getId() === $student_id)
                {
                    $epreuve->setNote($grade);
                    $em->persist($epreuve);
                    $em->flush();
                }
            }
            return $this -> redirectToRoute('app_note_epreuves_etudiant', ['id' => $student_id]);
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade value is incorrect');
        }
        //return $this -> redirectToRoute('app_note_epreuves_etudiant', ['id' => $student_id]);
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/grades/parcours/modification/{student_id}/{parcour_id}', name: 'app_parcours_grade_modification')]
    public function changeStudentParcoursGrade(ManagerRegistry $doc, int $student_id, int $parcour_id, Request $request) : Response
    {
        $em = $doc -> getManager();
        $form = $this -> createForm(EditTestGradeType::class);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $grade = $form['note'] -> getData();
            $inscriptionsParcours = $em -> getRepository(InscriptionParcour::class) -> findAll();
            foreach ($inscriptionsParcours as $parcour)
            {
                if ($parcour->getParcour()-> getId() === $parcour_id && $parcour->getEtudiant()-> getId() === $student_id)
                {
                    $parcour->setNote($grade);
                    $em->persist($parcour);
                    $em->flush();
                }
            }
            return $this -> redirectToRoute('app_note_parcours_etudiant', ['id' => $student_id]);
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade value is incorrect');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/grades/periode/modification/{student_id}/{periode_id}', name: 'app_periode_grade_modification')]
    public function changeStudentPeriodeGrade(ManagerRegistry $doc, int $student_id, int $periode_id, Request $request) : Response
    {
        $em = $doc -> getManager();
        $form = $this -> createForm(EditTestGradeType::class);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $grade = $form['note'] -> getData();
            $inscriptionsPeriode = $em -> getRepository(InscriptionPeriode::class) -> findAll();
            foreach ($inscriptionsPeriode as $periode)
            {
                if ($periode->getPeriode()-> getId() === $periode_id && $periode->getEtudiant()-> getId() === $student_id)
                {
                    $periode->setNote($grade);
                    $em->persist($periode);
                    $em->flush();
                }
            }
            return $this -> redirectToRoute('app_note_periode_etudiant', ['id' => $student_id]);
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade value is incorrect');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }
}
