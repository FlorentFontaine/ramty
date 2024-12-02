<?php

namespace App\Controller\Admin;

use App\Entity\TypeJob;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeJobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeJob::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('jobs')->setLabel('Emplois associés')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type d\'emploi')
            ->setEntityLabelInPlural('Types d\'emplois')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types d\'emplois')
            ->setPageTitle('new', 'Ajouter un nouveau type d\'emploi')
            ->setPageTitle('edit', 'Modifier le type d\'emploi')
            ->setPageTitle('detail', 'Détails du type d\'emploi');
    }
}
