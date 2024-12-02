<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Document::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            TextField::new('path')->setLabel('Chemin'),
            AssociationField::new('type')->setLabel('Type de document'),
            AssociationField::new('comments')->setLabel('Commentaires')->hideOnIndex(),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('alert')->setLabel('Alerte'),
            AssociationField::new('candidacy')->setLabel('Candidature'),
            AssociationField::new('event')->setLabel('Événement'),
            AssociationField::new('job')->setLabel('Métier'),
            AssociationField::new('location')->setLabel('Lieu'),
            AssociationField::new('research')->setLabel('Recherche'),
            AssociationField::new('staff')->setLabel('Personnel'),
            DateTimeField::new('created_at')->onlyOnDetail(),
            DateTimeField::new('updated_at')->onlyOnDetail(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des documents')
            ->setPageTitle('detail', 'Détail du document')
            ->setPageTitle('edit', 'Modifier le document')
            ->setPageTitle('new', 'Créer un document');
    }
}
