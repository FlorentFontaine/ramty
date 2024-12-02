<?php

namespace App\Controller\Admin;

use App\Entity\Tool;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ToolCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tool::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom de l\'outil'),
            DateTimeField::new('created_at')->onlyOnDetail(),
            DateTimeField::new('updated_at')->onlyOnDetail(),
            AssociationField::new('compagny')->setLabel('Compagnie')->autocomplete(),
            AssociationField::new('staff')->setLabel('Personnel associé')->autocomplete(),
            AssociationField::new('jobs')->setLabel('Emplois associés')->autocomplete(),
            AssociationField::new('fields')->setLabel('Champs associés')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Outil')
            ->setEntityLabelInPlural('Outils')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des outils')
            ->setPageTitle('new', 'Ajouter un nouvel outil')
            ->setPageTitle('edit', 'Modifier l\'outil')
            ->setPageTitle('detail', 'Détails de l\'outil');
    }
}
