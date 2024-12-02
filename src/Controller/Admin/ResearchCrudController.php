<?php

namespace App\Controller\Admin;

use App\Entity\Research;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResearchCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Research::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title')->setLabel('Titre'),
            DateTimeField::new('created_at')->hideOnForm()->setLabel('Créé le'),
            DateTimeField::new('updated_at')->hideOnForm()->setLabel('Modifié le'),
            AssociationField::new('type')->setLabel('Type de recherche'),
            AssociationField::new('comments')->setLabel('Commentaires'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('documents')->setLabel('Documents'),
            AssociationField::new('fields')->setLabel('Champs'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Recherche')
            ->setEntityLabelInPlural('Recherches')
            ->setSearchFields(['title']) // Champs à inclure dans la recherche
            ->setDefaultSort(['created_at' => 'DESC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des recherches')
            ->setPageTitle('new', 'Créer une nouvelle recherche')
            ->setPageTitle('edit', 'Modifier une recherche')
            ->setPageTitle('detail', 'Détails de la recherche');
    }
}
