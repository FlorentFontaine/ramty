<?php

namespace App\Form;

use App\Entity\Alert;
use App\Entity\Candidacy;
use App\Entity\Compagny;
use App\Entity\Document;
use App\Entity\Event;
use App\Entity\Job;
use App\Entity\Location;
use App\Entity\Research;
use App\Entity\Staff;
use App\Entity\Task;
use App\Entity\TypeDocument;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('path')
            ->add('created_at')
            ->add('updated_at')
            ->add('type', EntityType::class, [
                'class' => TypeDocument::class,
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
            ->add('alert', EntityType::class, [
                'class' => Alert::class,
'choice_label' => 'id',
            ])
            ->add('candidacy', EntityType::class, [
                'class' => Candidacy::class,
'choice_label' => 'id',
            ])
            ->add('event', EntityType::class, [
                'class' => Event::class,
'choice_label' => 'id',
            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,
'choice_label' => 'id',
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
'choice_label' => 'id',
            ])
            ->add('research', EntityType::class, [
                'class' => Research::class,
'choice_label' => 'id',
            ])
            ->add('staff', EntityType::class, [
                'class' => Staff::class,
'choice_label' => 'id',
            ])
            ->add('task', EntityType::class, [
                'class' => Task::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
