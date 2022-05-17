<?php

namespace App\Form;

use App\Controller\TypeNoteController;
use App\Entity\Epreuve;
use App\Entity\InscriptionEpreuve;
use App\Entity\PeriodeUe;
use App\Entity\TypeNote;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionEpreuveModificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('epreuve', TextType::class)
            ->add('typeNote', EntityType::class, ['class' => TypeNote::class, 'choice_label' => 'type'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InscriptionEpreuve::class,
        ]);
    }
}
