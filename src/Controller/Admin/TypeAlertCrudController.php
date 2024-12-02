<?php

namespace App\Controller\Admin;

use App\Entity\TypeAlert;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeAlertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeAlert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom du type d\'alerte'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
            AssociationField::new('alerts')->setLabel('Alertes associées')->autocomplete(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type d\'alerte')
            ->setEntityLabelInPlural('Types d\'alerte')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des types d\'alerte')
            ->setPageTitle('new', 'Ajouter un nouveau type d\'alerte')
            ->setPageTitle('edit', 'Modifier le type d\'alerte')
            ->setPageTitle('detail', 'Détails du type d\'alerte');
    }
}
