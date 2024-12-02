<?php

namespace App\Controller\Admin;

use App\Entity\TypeCandidacy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeCandidacyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeCandidacy::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom du type de candidature'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('candidacies')->setLabel('Candidatures associées')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de candidature')
            ->setEntityLabelInPlural('Types de candidature')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de candidature')
            ->setPageTitle('new', 'Ajouter un nouveau type de candidature')
            ->setPageTitle('edit', 'Modifier le type de candidature')
            ->setPageTitle('detail', 'Détails du type de candidature');
    }
}
