<?php

namespace App\Controller\Admin;

use App\Entity\TypeStep;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeStepCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeStep::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('steps')->setLabel('Étapes associées')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type d\'étape')
            ->setEntityLabelInPlural('Types d\'étapes')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types d\'étapes')
            ->setPageTitle('new', 'Ajouter un nouveau type d\'étape')
            ->setPageTitle('edit', 'Modifier le type d\'étape')
            ->setPageTitle('detail', 'Détails du type d\'étape');
    }
}
