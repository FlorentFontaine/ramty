<?php

namespace App\Form;

use App\Entity\Compagny;
use App\Entity\Competence;
use App\Entity\Staff;
use App\Entity\TypeCompetence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('created_at')
            ->add('updated_at')
            ->add('type', EntityType::class, [
                'class' => TypeCompetence::class,
                'choice_label' => 'id',
            ])
            ->add('compagny', EntityType::class, [
                'class' => Compagny::class,
                'choice_label' => 'id',
            ])
            ->add('staff', EntityType::class, [
                'class' => Staff::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competence::class,
        ]);
    }
}
