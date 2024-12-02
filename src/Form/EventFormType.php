<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Priority;
use App\Entity\Staff;
use App\Entity\StatusEvent;
use App\Entity\TypeEvent;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'tinymce',
                    'data-theme' => 'snow',
                    'style' => 'height: 100px',
                ],
            ])
            // ->add('created_at')
            // ->add('updated_at')
            ->add('period', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('due_date_at', DateType::class, [
                'widget' => 'choice',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('start_date_at', DateType::class, [
                'widget' => 'choice',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('end_date_at', DateType::class, [
                'widget' => 'choice',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                'choice_label' => 'name',
            ])
            ->add('type', EntityType::class, [
                'class' => TypeEvent::class,
                'choice_label' => 'name',
            ])
            ->add('status', EntityType::class, [
                'class' => StatusEvent::class,
                'choice_label' => 'name',
            ])
            // ->add('compagny')
            // ->add('created_by')
            ->add('assigned', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'choice_label' => 'email',
            ])
            ->add('attached', EntityType::class, [
                'class' => Staff::class,
                'multiple' => true,
                'choice_label' => 'fullname',
            ])
            ->add('jobs', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
