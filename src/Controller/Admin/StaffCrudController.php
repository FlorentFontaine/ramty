<?php

namespace App\Controller\Admin;

use App\Entity\Staff;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StaffCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Staff::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('firstname')->setLabel('Prénom'),
            TextField::new('lastname')->setLabel('Nom'),
            TextField::new('email')->setLabel('Email'),
            TextField::new('phone')->setLabel('Téléphone')->hideOnIndex(),
            DateTimeField::new('created_at')->setLabel('Créé le')->onlyOnDetail(),
            DateTimeField::new('updated_at')->setLabel('Modifié le')->onlyOnDetail(),
            AssociationField::new('type')->setLabel('Type'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('events')->setLabel('Événements'),
            AssociationField::new('documents')->setLabel('Documents'),
            AssociationField::new('addresses')->setLabel('Adresses'),
            AssociationField::new('tools')->setLabel('Outils'),
            AssociationField::new('criteriums')->setLabel('Critères'),
            AssociationField::new('comments')->setLabel('Commentaires'),
            AssociationField::new('candidacies')->setLabel('Candidatures'),
            AssociationField::new('sectors')->setLabel('Secteurs'),
            AssociationField::new('location')->setLabel('Lieu'),
            AssociationField::new('platform')->setLabel('Plateforme'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Personnel')
            ->setEntityLabelInPlural('Personnel')
            ->setSearchFields(['firstname', 'lastname', 'email']) // Champs à inclure dans la recherche
            ->setDefaultSort(['lastname' => 'ASC', 'firstname' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste du personnel')
            ->setPageTitle('new', 'Ajouter un nouveau personnel')
            ->setPageTitle('edit', 'Modifier le personnel')
            ->setPageTitle('detail', 'Détails du personnel');
    }
}
