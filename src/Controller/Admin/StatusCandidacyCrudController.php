<?php

namespace App\Controller\Admin;

use App\Entity\StatusCandidacy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatusCandidacyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusCandidacy::class;
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
            ->setEntityLabelInSingular('Statut de candidature')
            ->setEntityLabelInPlural('Statuts de candidature')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des statuts de candidature')
            ->setPageTitle('new', 'Ajouter un nouveau statut de candidature')
            ->setPageTitle('edit', 'Modifier le statut de candidature')
            ->setPageTitle('detail', 'Détails du statut de candidature');
    }
}
