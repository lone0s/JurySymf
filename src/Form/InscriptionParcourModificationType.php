<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\InscriptionParcour;
use App\Entity\TypeNote;
use App\Entity\TypeResultat;
use Proxies\__CG__\App\Entity\Parcour;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionParcourModificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('pointsJury')
            ->add('saisie')

            ->add('typeNote', EntityType::class, [
                'class' => TypeNote::class,
                'choice_label' => 'type'
            ])
            ->add('parcour', EntityType::class, [
                'class' => Parcour::class,
                'choice_label' => 'id',
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
            'data_class' => InscriptionParcour::class,
        ]);
    }
}
