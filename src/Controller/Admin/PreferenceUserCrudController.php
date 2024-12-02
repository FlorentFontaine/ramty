<?php

namespace App\Controller\Admin;

use App\Entity\PreferenceUser;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PreferenceUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PreferenceUser::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            BooleanField::new('dark_mode')->setLabel('Mode sombre'),
            AssociationField::new('user')->setLabel('Utilisateur'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Préférence utilisateur')
            ->setEntityLabelInPlural('Préférences utilisateur')
            ->setSearchFields(['dark_mode']) // Champs à inclure dans la recherche
            ->setDefaultSort(['id' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des préférences utilisateur')
            ->setPageTitle('new', 'Ajouter une nouvelle préférence utilisateur')
            ->setPageTitle('edit', 'Modifier la préférence utilisateur')
            ->setPageTitle('detail', 'Détails de la préférence utilisateur');
    }
}
