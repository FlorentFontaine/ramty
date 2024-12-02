<?php

namespace App\Controller\Admin;

use App\Entity\TypeCriteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeCriteriaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeCriteria::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('criterias')->setLabel('Critères associés')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de critère')
            ->setEntityLabelInPlural('Types de critères')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de critères')
            ->setPageTitle('new', 'Ajouter un nouveau type de critère')
            ->setPageTitle('edit', 'Modifier le type de critère')
            ->setPageTitle('detail', 'Détails du type de critère');
    }
}
