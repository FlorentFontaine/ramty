<?php

namespace App\Controller\Admin;

use App\Entity\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CriteriaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Criteria::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('type')->setLabel('Type'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('staff')->setLabel('Personnel'),
            AssociationField::new('jobs')->setLabel('Emplois'),
            AssociationField::new('fields')->setLabel('Champs'),
            DateTimeField::new('created_at')->onlyOnIndex()->setLabel('Créé le'),
            DateTimeField::new('updated_at')->onlyOnIndex()->setLabel('Modifié le'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des critères')
            ->setPageTitle('detail', 'Détail du critère')
            ->setPageTitle('edit', 'Modifier le critère')
            ->setPageTitle('new', 'Créer un critère');
    }
}

