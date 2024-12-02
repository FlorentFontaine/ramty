<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Compagny;
use App\Entity\StatusTask;
use App\Entity\Step;
use App\Entity\Task;
use App\Entity\TypeTask;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('created_at')
            ->add('updated_at')
            ->add('start_date_at')
            ->add('end_date_at')
            ->add('type', EntityType::class, [
                'class' => TypeTask::class,
                'choice_label' => 'id',
            ])
            ->add('created_by', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('compagny', EntityType::class, [
                'class' => Compagny::class,
                'choice_label' => 'id',
            ])
            ->add('comments', EntityType::class, [
                'class' => Comment::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('assigned', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('steps', EntityType::class, [
                'class' => Step::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('status', EntityType::class, [
                'class' => StatusTask::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
