<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\InscriptionUe;
use App\Entity\Parcour;
use App\Entity\Periode;
use App\Entity\PeriodeUe;
use App\Entity\TypeNote;
use App\Entity\TypeResultat;
use App\Repository\PeriodeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionUeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('pointsJury')
            ->add('saisie')
            ->add('etudiant', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => 'numero',
            ])
            ->add('typeNote', EntityType::class, [
                'class' => TypeNote::class,
                'choice_label' => 'type'
            ])
           ->add('periodeUe', EntityType::class, [
                'class' => PeriodeUe::class,
                'choice_label' => 'id',
            ])
            // A voir plus tard pour modification dynamiques des valeurs dans
                // En attendant on passera par un formulaire de periode ue 
/*            -> add('Parcours', EntityType::class, [
                'class' => Parcour::class,
                'choice_label' => 'nom'
            ])
            -> add('Periode', EntityType::class, [
                'class' => Periode::class,
                'query_builder' => function(PeriodeRepository $periodeRepository) {
                return $periodeRepository -> createQueryBuilder('data')
                    -> where('data.parcour' = $this)
                }
                ,'choice_label' => 'numero'
            ])
            -> add('Ue', EntityType::class, [
                'class' => Periode::class,
                'choice_label'
            ])*/
            ->add('typeResultat', EntityType::class,[
                'class' => TypeResultat::class,
                'choice_label' => 'type'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InscriptionUe::class,
        ]);
    }
}
