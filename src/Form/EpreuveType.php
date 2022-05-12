<?php

namespace App\Form;

use App\Entity\Epreuve;
use App\Entity\NatureEpreuve;
use App\Entity\Ue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpreuveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('coefficient')
            ->add('rang')
            ->add('session1')
            ->add('session2')
            ->add('duree')
            ->add('natureEpreuve', EntityType::class, ['class' => NatureEpreuve::class, 'choice_label' => 'nature'])
            ->add('ue', EntityType::class, ['class' => Ue::class, 'choice_label' => 'nom'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Epreuve::class,
        ]);
    }
}
