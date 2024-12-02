<?php

namespace App\Controller\Admin;

use App\Entity\StatusJob;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatusJobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusJob::class;
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
            ->setEntityLabelInSingular('Statut de poste')
            ->setEntityLabelInPlural('Statuts de poste')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des statuts de poste')
            ->setPageTitle('new', 'Ajouter un nouveau statut de poste')
            ->setPageTitle('edit', 'Modifier le statut de poste')
            ->setPageTitle('detail', 'Détails du statut de poste');
    }
}
