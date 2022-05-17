<?php

namespace App\Form;

use App\Entity\Epreuve;
use App\Entity\Etudiant;
use App\Entity\InscriptionEpreuve;
use App\Entity\PeriodeUe;
use App\Entity\TypeNote;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionEpreuveCreatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //'class' => Diplome::class, 'choice_label' => 'libelle'
            ->add('note')
            ->add('epreuve', EntityType::class,
                ['class' => Epreuve::class,'choice_label' => 'nom','disabled' => true])
            ->add('periodeUe', EntityType::class,
                ['class' => PeriodeUe::class,'choice_label' => 'id', 'disabled' => true])
            ->add('etudiant', EntityType::class,
                ['class' => Etudiant::class, 'choice_label' => 'numero'])
            ->add('typeNote', EntityType::class,
                ['class' =>TypeNote::class, 'choice_label' => 'type'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InscriptionEpreuve::class,
        ]);
    }
}
