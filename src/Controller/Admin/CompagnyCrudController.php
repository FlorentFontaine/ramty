<?php

namespace App\Controller\Admin;

use App\Entity\Compagny;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\OneToManyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompagnyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Compagny::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            BooleanField::new('active')->setLabel('Active'),
            DateTimeField::new('created_at')->setLabel('Date de création'),
            DateTimeField::new('updated_at')->setLabel('Date de mise à jour')->onlyOnDetail(),
            AssociationField::new('users')->setLabel('Utilisateurs'),
            AssociationField::new('staffs')->setLabel('Personnel'),
            AssociationField::new('Events')->setLabel('Événements'),
            AssociationField::new('Alerts')->setLabel('Alertes'),
            AssociationField::new('Criteriums')->setLabel('Critères'),
            AssociationField::new('documents')->setLabel('Documents'),
            AssociationField::new('addresses')->setLabel('Adresses'),
            AssociationField::new('candidacies')->setLabel('Candidatures'),
            AssociationField::new('researches')->setLabel('Recherches'),
            AssociationField::new('locations')->setLabel('Lieux'),
            AssociationField::new('sectors')->setLabel('Secteurs'),
            AssociationField::new('tools')->setLabel('Outils'),
            AssociationField::new('competences')->setLabel('Compétences'),
            AssociationField::new('chat')->setLabel('Chat'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des compagnies')
            ->setPageTitle('detail', 'Détail de la compagnie')
            ->setPageTitle('edit', 'Modifier la compagnie')
            ->setPageTitle('new', 'Créer une compagnie');
    }
}

