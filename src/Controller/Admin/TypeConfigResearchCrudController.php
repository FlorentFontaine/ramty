<?php

namespace App\Controller\Admin;

use App\Entity\TypeConfigResearch;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeConfigResearchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeConfigResearch::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('operator')->setLabel('Opérateur'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('configResearch')->setLabel('Configurations de recherche associées')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de configuration de recherche')
            ->setEntityLabelInPlural('Types de configurations de recherche')
            ->setSearchFields(['operator']) // Champs à inclure dans la recherche
            ->setDefaultSort(['operator' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de configurations de recherche')
            ->setPageTitle('new', 'Ajouter un nouveau type de configuration de recherche')
            ->setPageTitle('edit', 'Modifier le type de configuration de recherche')
            ->setPageTitle('detail', 'Détails du type de configuration de recherche');
    }
}
