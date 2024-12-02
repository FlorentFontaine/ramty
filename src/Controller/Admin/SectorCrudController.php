<?php

namespace App\Controller\Admin;

use App\Entity\Sector;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SectorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sector::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('staff')->setLabel('Personnel'),
            AssociationField::new('jobs')->setLabel('Emplois'),
            AssociationField::new('teams')->setLabel('Équipes'),
            AssociationField::new('locations')->setLabel('Lieux'),
            AssociationField::new('fields')->setLabel('Champs'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Secteur')
            ->setEntityLabelInPlural('Secteurs')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des secteurs')
            ->setPageTitle('new', 'Créer un nouveau secteur')
            ->setPageTitle('edit', 'Modifier un secteur')
            ->setPageTitle('detail', 'Détails du secteur');
    }
}
