<?php

namespace App\Controller\Admin;

use App\Entity\StatusEvent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StatusEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatusEvent::class;
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
            ->setEntityLabelInSingular('Statut d\'événement')
            ->setEntityLabelInPlural('Statuts d\'événement')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des statuts d\'événement')
            ->setPageTitle('new', 'Ajouter un nouveau statut d\'événement')
            ->setPageTitle('edit', 'Modifier le statut d\'événement')
            ->setPageTitle('detail', 'Détails du statut d\'événement');
    }
}
