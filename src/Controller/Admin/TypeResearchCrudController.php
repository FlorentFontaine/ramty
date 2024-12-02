<?php

namespace App\Controller\Admin;

use App\Entity\TypeResearch;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeResearchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeResearch::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('research')->setLabel('Recherches associées')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de recherche')
            ->setEntityLabelInPlural('Types de recherches')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de recherches')
            ->setPageTitle('new', 'Ajouter un nouveau type de recherche')
            ->setPageTitle('edit', 'Modifier le type de recherche')
            ->setPageTitle('detail', 'Détails du type de recherche');
    }
}
