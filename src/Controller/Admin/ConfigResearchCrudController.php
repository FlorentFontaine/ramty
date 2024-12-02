<?php

namespace App\Controller\Admin;

use App\Entity\ConfigResearch;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConfigResearchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConfigResearch::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('type')->setLabel('Type de configuration'),
            AssociationField::new('fields')->setLabel('Champs de configuration'),
            DateTimeField::new('createdAt')->onlyOnDetail(),
            DateTimeField::new('updatedAt')->onlyOnDetail(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des configurations de recherche')
            ->setPageTitle('detail', 'Détail de la configuration de recherche')
            ->setPageTitle('edit', 'Modifier la configuration de recherche')
            ->setPageTitle('new', 'Créer une configuration de recherche');
    }
}
