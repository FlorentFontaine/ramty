<?php

namespace App\Controller\Admin;

use App\Entity\Platform;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlatformCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Platform::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('staff')->setLabel('Personnel'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Plateforme')
            ->setEntityLabelInPlural('Plateformes')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['id' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des plateformes')
            ->setPageTitle('new', 'Créer une nouvelle plateforme')
            ->setPageTitle('edit', 'Modifier une plateforme')
            ->setPageTitle('detail', 'Détails de la plateforme');
    }
}
