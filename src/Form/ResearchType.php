<?php

namespace App\Form;

use App\Entity\Compagny;
use App\Entity\Research;
use App\Entity\TypeResearch;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('created_at')
            ->add('updated_at')
            ->add('type', EntityType::class, [
                'class' => TypeResearch::class,
                'choice_label' => 'id',
            ])
            ->add('compagny', EntityType::class, [
                'class' => Compagny::class,
                'choice_label' => 'id',
            ])
            ->add('created_by', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Research::class,
        ]);
    }
}
