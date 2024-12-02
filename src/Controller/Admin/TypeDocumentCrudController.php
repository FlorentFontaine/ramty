<?php

namespace App\Controller\Admin;

use App\Entity\TypeDocument;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeDocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeDocument::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('documents')->setLabel('Documents associés')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de document')
            ->setEntityLabelInPlural('Types de documents')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de documents')
            ->setPageTitle('new', 'Ajouter un nouveau type de document')
            ->setPageTitle('edit', 'Modifier le type de document')
            ->setPageTitle('detail', 'Détails du type de document');
    }
}
