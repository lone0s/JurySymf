<?php

namespace App\Controller\Notes;

use App\Entity\Epreuve;
use App\Entity\Etudiant;
use App\Entity\InscriptionEpreuve;
use App\Entity\InscriptionParcour;
use App\Entity\InscriptionPeriode;
use App\Entity\InscriptionUe;
use App\Form\EditTestGradeType;
use App\Form\InscriptionEpreuveModificationType;
use App\Form\InscriptionParcoursType;
use App\Form\InscriptionPeriodeModificationType;
use App\Form\InscriptionUeModificationType;
use Doctrine\Persistence\ManagerRegistry;
use http\Exception\InvalidArgumentException;
use HttpInvalidParamException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GradesModificationController extends AbstractController
{
/*    #[Route('/grades/test/modification/{student_id}/{epreuve_id}', name: 'app_epreuve_grade_modification')]
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

    #[Route('/grades/parcours/modification/{student_id}/', name: 'app_parcours_grade_modification')]
    public function changeStudentParcoursGrade(ManagerRegistry $doc, int $student_id, Request $request) : Response
    {*/
        // A REVOIR + RECONCEVOIR POUR ADAPTER FORMULAIRE DE MODIFICATION A ETUDIANT
        /*
        $em = $doc -> getManager();
        $student = $em -> getRepository(Etudiant::class) -> find($student_id);
        if (!$student)
            throw new InvalidArgumentException();
        $studentParcourGrades = $em -> getRepository(InscriptionParcour::class) -> findBy(['etudiant' => $student]);
        $form = $this -> createForm(InscriptionParcoursType::class, $studentParcourGrades);
        $form -> add("send", SubmitType::class, ['label' => "Modifier Note Parcours"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
                if ($form['etudiant'] -> getId() != $student -> getId())
                    throw new InvalidArgumentException();
                else {
                    $studentParcourGrades = $form -> getData();
                    $em -> persist($studentParcourGrades);
                    $em -> flush();
                    return $this -> redirectToRoute('app_note_parcours_etudiant', ['id' => $student_id]);
                }
            }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade value is incorrect');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);*/
/*    }*/

/*    #[Route('/grades/periode/modification/{student_id}/{periode_id}', name: 'app_periode_grade_modification')]
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
    }*/

    // !!! Formulaire a base d'éléments prééxistents sinon pb !
/*    #[Route('/grades/add/testGrade/{student_id}', name: 'app_add_student_test_grade')]
    public function addStudentExamGrade(ManagerRegistry $doc, int $student_id, Request $request) : Response
    {
        $em = $doc -> getManager();
        $inscriptionEpreuve = new InscriptionEpreuve();
        $form = $this -> createForm(InscriptionEpreuveModificationType::class,$inscriptionEpreuve);
        $form -> add("send", SubmitType::class, ['label' => "Ajouter Note Examen"]);
        $form -> handleRequest($request);
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
    }*/

    #[Route('/notes/epreuves/modifier/{inscriptionEpreuveId}', name : '_epreuve_grade')]
    public function changeEpreuveGrade(ManagerRegistry $doc, Request $request, int $inscriptionEpreuveId) : Response {
        $em = $doc -> getManager();
        $inscriptionEpreuve = $em -> getRepository(InscriptionEpreuve::class) -> find($inscriptionEpreuveId);
        if (! $inscriptionEpreuve)
        {
            throw new InvalidArgumentException('Incorrect InscriptionEpreuve id');
        }
        $form = $this -> createForm(InscriptionEpreuveModificationType::class, $inscriptionEpreuve);
        $form -> add("send", SubmitType::class, ['label' => "Modifier note à l'epreuve"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $inscriptionEpreuve = $form -> getData();
            $em -> persist($inscriptionEpreuve);
            $em -> flush();
            return  $this -> redirectToRoute('_epreuves_list');
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade information is incorrect');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/notes/ues/modifier/{inscriptionUeId}', name : '_ue_grade')]
    public function changeUeGrade(ManagerRegistry $doc, Request $request, int $inscriptionUeId) : Response {
        $em = $doc -> getManager();
        $inscriptionUe = $em -> getRepository(InscriptionUe::class) -> find($inscriptionUeId);
        if (! $inscriptionUe)
        {
            throw new InvalidArgumentException('Incorrect InscriptionUe id');
        }
        $form = $this -> createForm(InscriptionUeModificationType::class, $inscriptionUe);
        $form -> add("send", SubmitType::class, ['label' => "Modifier note à l'UE"]);
        $form -> handleRequest($request);
        $oldGrade = $inscriptionUe -> getNote();
        if ($form -> isSubmitted() && $form -> isValid()) {
            $inscriptionUe = $form -> getData();
            dump($oldGrade);
            dump($form['note'] -> getData());
            if ($oldGrade !== ($form['note'] -> getData()))
                {
                    $inscriptionUe -> setSaisie(1);
                }
            $em -> persist($inscriptionUe);
            $em -> flush();
            return  $this -> redirectToRoute('_ues_list');
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade information is incorrect');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/notes/periodes/modifier/{inscriptionPeriodeId}', name : '_periode_grade')]
    public function changePeriodeGrade(ManagerRegistry $doc, Request $request, int $inscriptionPeriodeId) : Response {
        $em = $doc -> getManager();
        $inscriptionPeriode = $em -> getRepository(InscriptionEpreuve::class) -> find($inscriptionPeriodeId);
        if (! $inscriptionPeriode)
        {
            throw new InvalidArgumentException('Incorrect InscriptionPeriode id');
        }
        $form = $this -> createForm(InscriptionPeriodeModificationType::class, $inscriptionPeriode);
        $form -> add("send", SubmitType::class, ['label' => "Modifier note sur la période"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $inscriptionPeriode = $form -> getData();
            $em -> persist($inscriptionPeriode);
            $em -> flush();
            return  $this -> redirectToRoute('_periodes_list');
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade information is incorrect');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }

    #[Route('/notes/parcours/modifier/{inscriptionParcourId}', name : '_parcours_grade')]
    public function changeParcoursGrade(ManagerRegistry $doc, Request $request, int $inscriptionParcourId) : Response {
        $em = $doc -> getManager();
        $inscriptionParcour = $em -> getRepository(InscriptionEpreuve::class) -> find($inscriptionParcourId);
        if (! $inscriptionParcour)
        {
            throw new InvalidArgumentException('Incorrect InscriptionParcours id');
        }
        $form = $this -> createForm(InscriptionPeriodeModificationType::class, $inscriptionParcour);
        $form -> add("send", SubmitType::class, ['label' => "Modifier note sur la période"]);
        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid()) {
            $inscriptionParcour = $form -> getData();
            $em -> persist($inscriptionParcour);
            $em -> flush();
            return  $this -> redirectToRoute('_parcours_list');
        }
        if ($form -> isSubmitted()) {
            $this->addFlash('error', 'New grade information is incorrect');
        }
        $args = array("formulaire" => $form->createView());
        return $this -> render("forms/FormView.html.twig",$args);
    }
}
