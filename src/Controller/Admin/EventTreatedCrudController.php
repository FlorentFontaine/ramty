<?php

namespace App\Controller\Admin;

use App\Entity\EventTreated;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class EventTreatedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventTreated::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('user')->setLabel('Utilisateur'),
            AssociationField::new('event')->setLabel('Événement'),
            DateTimeField::new('created_at')->setLabel('Créé le')->onlyOnDetail(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des événements traités')
            ->setPageTitle('detail', 'Détail de l\'événement traité')
            ->setPageTitle('edit', 'Modifier l\'événement traité')
            ->setPageTitle('new', 'Créer un événement traité');
    }
}
