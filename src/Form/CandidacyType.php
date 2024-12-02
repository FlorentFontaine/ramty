<?php

namespace App\Form;

use App\Entity\Candidacy;
use App\Entity\Compagny;
use App\Entity\Job;
use App\Entity\Staff;
use App\Entity\StatusCandidacy;
use App\Entity\TypeCandidacy;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidacyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('created_at')
            ->add('updated_at')
            ->add('type', EntityType::class, [
                'class' => TypeCandidacy::class,
                'choice_label' => 'id',
            ])
            ->add('status', EntityType::class, [
                'class' => StatusCandidacy::class,
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
            ->add('staff', EntityType::class, [
                'class' => Staff::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidacy::class,
        ]);
    }
}
