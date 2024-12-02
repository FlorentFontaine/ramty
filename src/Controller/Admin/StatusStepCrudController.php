<?php

namespace App\Controller\Admin;

use App\Entity\StatusStep;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatusStepCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusStep::class;
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
            ->setEntityLabelInSingular('Statut d\'étape')
            ->setEntityLabelInPlural('Statuts d\'étape')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des statuts d\'étape')
            ->setPageTitle('new', 'Ajouter un nouveau statut d\'étape')
            ->setPageTitle('edit', 'Modifier le statut d\'étape')
            ->setPageTitle('detail', 'Détails du statut d\'étape');
    }
}
