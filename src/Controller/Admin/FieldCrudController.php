<?php

namespace App\Controller\Admin;

use App\Entity\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FieldCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Field::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('researches')->setLabel('Recherche'),
            AssociationField::new('config')->setLabel('Configuration de recherche'),
            AssociationField::new('tools')->setLabel('Outils'),
            AssociationField::new('criteriums')->setLabel('Critères'),
            AssociationField::new('sectors')->setLabel('Secteurs'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des champs')
            ->setPageTitle('detail', 'Détail du champ')
            ->setPageTitle('edit', 'Modifier le champ')
            ->setPageTitle('new', 'Créer un champ');
    }
}
