<?php

namespace App\Form;

use App\Entity\Criteria;
use App\Entity\Event;
use App\Entity\Job;
use App\Entity\Sector;
use App\Entity\StatusJob;
use App\Entity\Tool;
use App\Entity\TypeJob;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('created_at')
            ->add('updated_at')
            ->add('type', EntityType::class, [
                'class' => TypeJob::class,
                'choice_label' => 'id',
            ])
            ->add('status', EntityType::class, [
                'class' => StatusJob::class,
                'choice_label' => 'id',
            ])
            ->add('tools', EntityType::class, [
                'class' => Tool::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('criteriums', EntityType::class, [
                'class' => Criteria::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('sectors', EntityType::class, [
                'class' => Sector::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('events', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
