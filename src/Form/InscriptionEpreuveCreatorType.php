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
            ->add('note')
            ->add('epreuve', EntityType::class,
                [
                    'class' => Epreuve::class,
                    'choice_label' => function($epreuve) {
                        return
                             $epreuve -> getUe() -> getNom() .
                            ' - ' . $epreuve -> getNom();
                    }
                ])
            ->add('periodeUe', EntityType::class,
                ['class' => PeriodeUe::class,
                    'choice_label' => function($periodeUe)
                    {
                return
                    'Parcour '.$periodeUe -> getPeriode() -> getParcour() -> getNom()
                    . ' | ' . $periodeUe -> getPeriode() -> getNumero() .
                    ' - ' . $periodeUe -> getPeriode() -> getCodeApogee() .
                    ' | UE: ' . $periodeUe -> getUe() -> getNom();
                    }
                ])
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
