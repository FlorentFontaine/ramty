<?php

namespace App\Controller\Admin;

use App\Entity\Priority;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PriorityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Priority::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('events')->setLabel('Événements'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Priority')
            ->setEntityLabelInPlural('Priorities')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des priorités')
            ->setPageTitle('new', 'Ajouter une nouvelle priorité')
            ->setPageTitle('edit', 'Modifier la priorité')
            ->setPageTitle('detail', 'Détails de la priorité');
    }
}
