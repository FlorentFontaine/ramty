<?php

namespace App\Controller\Admin;

use App\Entity\TypeCompetence;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeCompetenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeCompetence::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom du type de compétence'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('competences')->setLabel('Compétences associées')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de compétence')
            ->setEntityLabelInPlural('Types de compétence')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de compétence')
            ->setPageTitle('new', 'Ajouter un nouveau type de compétence')
            ->setPageTitle('edit', 'Modifier le type de compétence')
            ->setPageTitle('detail', 'Détails du type de compétence');
    }
}
