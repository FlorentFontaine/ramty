<?php

namespace App\Controller\Admin;

use App\Entity\Step;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StepCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Step::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title')->setLabel('Titre'),
            TextEditorField::new('content')->setLabel('Contenu'),
            DateTimeField::new('created_at')->onlyOnIndex(),
            DateTimeField::new('updated_at')->onlyOnIndex(),
            TextField::new('type.name')->setLabel('Type'),
            TextField::new('status.name')->setLabel('Statut'),
            TextField::new('created_by.email')->setLabel('Créé par'),
            TextField::new('event.title')->setLabel('Événement'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Étape')
            ->setEntityLabelInPlural('Étapes')
            ->setSearchFields(['title']) // Champs à inclure dans la recherche
            ->setDefaultSort(['created_at' => 'DESC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des étapes')
            ->setPageTitle('new', 'Ajouter une nouvelle étape')
            ->setPageTitle('edit', 'Modifier l\'étape')
            ->setPageTitle('detail', 'Détails de l\'étape');
    }
}
