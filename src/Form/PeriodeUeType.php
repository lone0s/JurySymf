<?php

namespace App\Form;

use App\Entity\Parcour;
use App\Entity\Periode;
use App\Entity\PeriodeUe;
use App\Entity\Ue;
use App\Repository\PeriodeRepository;
use App\Repository\UeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeriodeUeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
/*        $builder
            ->add('parcours', EntityType::class, [
                'mapped' => false, // <== Pour indiquer que ressource extérieure a PeriodeUe
                'class' => Parcour::class,
                'choice_label' => 'nom',
                'placeholder' => 'Parcours',
                'label' => 'Parcours'
            ])
            ->add('ue', EntityType::class, [
                'class' => Ue::class,
                'choice_label' => 'nom',
                'placeholder' => 'UE',
                'label' => 'Ue'
            ])
            ->add('periode', EntityType::class, [
                'class' => Periode::class,
                'choice_label' => ''
            ])
        ;
        $builder -> get('parcours') -> addEventListener(
            //Premier param = event sur lequel on Listen
            FormEvents::PRE_SUBMIT,function (UeRepository )
        )*/

        $builder
/*            -> add('periode', EntityType::class, [
                'class' => Periode::class,
                'choice_label' => function($periode) {
                    return $periode -> getNumero() . ' | ' . $periode -> getCodeApogee() . ' | ' . $periode -> getParcour() -> getNom();
                },
            ])
            -> add('ue', EntityType::class, [
                'class' => Ue::class,
                'choice_label' =>
            ])*/
            ->add('periode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PeriodeUe::class,
        ]);
    }
}
