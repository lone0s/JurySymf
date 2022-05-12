<?php

namespace App\Controller\Notes;

use App\Entity\Epreuve;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Form\EditTestGradeType;
use App\Form\InscriptionEpreuveType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $form -> add("send", SubmitType::class, ['label' => "Modifier Note Examen"]);
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
                    $this->addFlash('success', 'New grade successfully added');
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
        $form -> add("send", SubmitType::class, ['label' => "Modifier Note Parcours"]);
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
                    $this->addFlash('success', 'New grade successfully added');
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
        $form -> add("send", SubmitType::class, ['label' => "Modifier Note Periode"]);
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
                    $this->addFlash('success', 'New grade successfully added');
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

    // !!! Formulaire a base d'éléments prééxistents sinon pb !
    #[Route('/grades/add/testGrade/{student_id}', name: 'app_add_student_test_grade')]
    public function addStudentExamGrade(ManagerRegistry $doc, int $student_id, Request $request) : Response
    {
        $em = $doc -> getManager();
        $inscriptionEpreuve = new InscriptionEpreuve();
        $form = $this -> createForm(InscriptionEpreuveType::class,$inscriptionEpreuve);
        $form -> add("send", SubmitType::class, ['label' => "Ajouter Note Examen"]);
        if ($form -> isSubmitted()&& $form -> isValid()) {
            $form['etudiant'] -> setData($student_id);
            dump($form['etudiant']);
            $inscriptionEpreuve = $form -> getData();
            $em -> persist($inscriptionEpreuve);
            $em -> flush();
            $this->addFlash('success', 'New grade successfully added');
            return $this -> redirectToRoute('app_note_epreuves_etudiant', ['id' => $student_id]);
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade got incorrect values');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }


}
