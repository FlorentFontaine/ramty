<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('addresses')->setLabel('Adresses'),
            AssociationField::new('documents')->setLabel('Documents'),
            AssociationField::new('sectors')->setLabel('Secteurs'),
            AssociationField::new('staffs')->setLabel('Personnel'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Localisation')
            ->setEntityLabelInPlural('Localisations')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['id' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des localisations')
            ->setPageTitle('new', 'Créer une nouvelle localisation')
            ->setPageTitle('edit', 'Modifier une localisation')
            ->setPageTitle('detail', 'Détails de la localisation');
    }
}
