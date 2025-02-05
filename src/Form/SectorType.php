<?php

namespace App\Form;

use App\Entity\Sector;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('compagny')
            ->add('staff')
            ->add('jobs')
            ->add('teams')
            ->add('locations')
            ->add('fields')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sector::class,
        ]);
    }
}
