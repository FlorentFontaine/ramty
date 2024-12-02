<?php

namespace App\Controller\Admin;

use App\Entity\TypeLevel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeLevelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeLevel::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom du type de niveau'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('levels')->setLabel('Niveaux associés')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de niveau')
            ->setEntityLabelInPlural('Types de niveau')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de niveau')
            ->setPageTitle('new', 'Ajouter un nouveau type de niveau')
            ->setPageTitle('edit', 'Modifier le type de niveau')
            ->setPageTitle('detail', 'Détails du type de niveau');
    }
}
