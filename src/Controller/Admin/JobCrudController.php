<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdentifierField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Job::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('content')->setLabel('Contenu'),
            DateTimeField::new('created_at')->hideOnForm()->setLabel('Créé le'),
            DateTimeField::new('updated_at')->hideOnForm()->setLabel('Modifié le'),
            AssociationField::new('type')->setLabel('Type'),
            AssociationField::new('status')->setLabel('Statut'),
            AssociationField::new('comments')->setLabel('Commentaires'),
            AssociationField::new('documents')->setLabel('Documents'),
            AssociationField::new('candidacies')->setLabel('Candidatures'),
            AssociationField::new('tools')->setLabel('Outils'),
            AssociationField::new('criteriums')->setLabel('Critères'),
            AssociationField::new('sectors')->setLabel('Secteurs'),
            AssociationField::new('events')->setLabel('Événements'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Job')
            ->setEntityLabelInPlural('Jobs')
            ->setDateTimeFormat('yyyy-MM-dd HH:mm:ss')
            ->setSearchFields(['title', 'content']) // Champs à inclure dans la recherche
            ->setDefaultSort(['created_at' => 'DESC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des emplois')
            ->setPageTitle('new', 'Créer un nouvel emploi')
            ->setPageTitle('edit', 'Modifier un emploi')
            ->setPageTitle('detail', 'Détails de l\'emploi');
    }
}

