<?php

namespace App\Controller\Admin;

use App\Entity\StatusAlert;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatusAlertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusAlert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            IntegerField::new('position')->setLabel('Ordre d\'affichage'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Statut d\'alerte')
            ->setEntityLabelInPlural('Statuts d\'alerte')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des statuts d\'alerte')
            ->setPageTitle('new', 'Ajouter un nouveau statut d\'alerte')
            ->setPageTitle('edit', 'Modifier le statut d\'alerte')
            ->setPageTitle('detail', 'Détails du statut d\'alerte');
    }
}
