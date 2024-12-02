<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('content')->setLabel('Contenu')->hideOnIndex(),
            AssociationField::new('type')->setLabel('Type d\'événement'),
            AssociationField::new('status')->setLabel('Statut'),
            AssociationField::new('comments')->setLabel('Commentaires')->hideOnIndex(),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('assigned')->setLabel('Assigné à'),
            AssociationField::new('steps')->setLabel('Étapes')->hideOnIndex(),
            AssociationField::new('attached')->setLabel('Personnel attaché'),
            AssociationField::new('documents')->setLabel('Documents')->hideOnIndex(),
            AssociationField::new('jobs')->setLabel('Métiers')->hideOnIndex(),
            AssociationField::new('eventTreateds')->setLabel('Événements traités')->hideOnIndex(),
            DateTimeField::new('due_date_at')->setLabel('Date d\'échéance')->onlyOnDetail(),
            DateTimeField::new('start_date_at')->setLabel('Date de début')->onlyOnDetail(),
            DateTimeField::new('end_date_at')->setLabel('Date de fin')->onlyOnDetail(),
            BooleanField::new('period')->setLabel('Période')->onlyOnDetail(),
            AssociationField::new('priority')->setLabel('Priorité')->onlyOnDetail(),
            DateTimeField::new('created_at')->onlyOnDetail(),
            DateTimeField::new('updated_at')->onlyOnDetail(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des événements')
            ->setPageTitle('detail', 'Détail de l\'événement')
            ->setPageTitle('edit', 'Modifier l\'événement')
            ->setPageTitle('new', 'Créer un événement');
    }
}
