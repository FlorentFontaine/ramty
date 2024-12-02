<?php

namespace App\Controller\Admin;

use App\Entity\TypeStaff;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeStaffCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeStaff::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('staff')->setLabel('Personnels associés')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de personnel')
            ->setEntityLabelInPlural('Types de personnels')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de personnels')
            ->setPageTitle('new', 'Ajouter un nouveau type de personnel')
            ->setPageTitle('edit', 'Modifier le type de personnel')
            ->setPageTitle('detail', 'Détails du type de personnel');
    }
}
