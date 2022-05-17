<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\InscriptionPeriode;
use App\Entity\Periode;
use App\Entity\TypeNote;
use App\Entity\TypeResultat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionPeriodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('pointsJury')
            ->add('saisie')
            ->add('inscriptionPartielle')
            ->add('etudiant', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => 'numero'
            ])
            ->add('typeNote', EntityType::class, [
                'class' => TypeNote::class,
                'choice_label' => 'type'
            ])
            ->add('periode',EntityType::class, [
                'class' => Periode::class,
                'choice_label' => 'codeApogee',
                'disabled' => true
            ])
            ->add('typeResultat', EntityType::class,[
                'class' => TypeResultat::class,
                'choice_label' => 'type'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InscriptionPeriode::class,
        ]);
    }
}
