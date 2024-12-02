<?php

namespace App\Controller\Admin;

use App\Entity\TypeTask;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeTaskCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeTask::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('task')->setLabel('Tâches associées')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type de tâche')
            ->setEntityLabelInPlural('Types de tâches')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types de tâches')
            ->setPageTitle('new', 'Ajouter un nouveau type de tâche')
            ->setPageTitle('edit', 'Modifier le type de tâche')
            ->setPageTitle('detail', 'Détails du type de tâche');
    }
}
