<?php

namespace App\Form;

use App\Entity\Diplome;
use App\Entity\Mention;
use App\Entity\Ufr;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MentionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('nomCourt')
            ->add('anneeDebut')
            ->add('anneeFin')
            ->add('actif')
            ->add('commentaire')
            ->add('diplome', EntityType::class, ['class' => Diplome::class, 'choice_label' => 'libelle'])
            ->add('ufr', EntityType::class, ['class' => Ufr::class, 'choice_label' => 'denomination'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mention::class,
        ]);
    }
}
