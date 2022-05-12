<?php

namespace App\Form;

use App\Entity\InscriptionEpreuve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditTestGradeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            //->add('epreuve')
            //->add('periodeUe')
            //->add('etudiant')
            //->add('typeNote')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InscriptionEpreuve::class,
        ]);
    }
}
