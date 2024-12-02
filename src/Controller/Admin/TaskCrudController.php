<?php

namespace App\Controller\Admin;

use App\Entity\Task;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TaskCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Task::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('content')->setLabel('Contenu')->hideOnIndex(),
            AssociationField::new('board')->setLabel('Tableau'),
            AssociationField::new('type')->setLabel('Type d\'tâche'),
            AssociationField::new('status')->setLabel('Statut'),
            AssociationField::new('comments')->setLabel('Commentaires')->hideOnIndex(),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('assigned')->setLabel('Assigné à'),
            AssociationField::new('steps')->setLabel('Étapes')->hideOnIndex(),
            AssociationField::new('documents')->setLabel('Documents')->hideOnIndex(),
            DateTimeField::new('start_date_at')->setLabel('Date de début')->onlyOnDetail(),
            DateTimeField::new('end_date_at')->setLabel('Date de fin')->onlyOnDetail(),
            AssociationField::new('priority')->setLabel('Priorité')->onlyOnDetail(),
            DateTimeField::new('created_at')->onlyOnDetail(),
            DateTimeField::new('updated_at')->onlyOnDetail(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des tâches')
            ->setPageTitle('detail', 'Détail de tâche')
            ->setPageTitle('edit', 'Modifier tâche')
            ->setPageTitle('new', 'Créer un tâche');
    }
}
