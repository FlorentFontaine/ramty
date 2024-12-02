<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('street')->setLabel('Rue'),
            IntegerField::new('postal_code')->setLabel('Code postal'),
            AssociationField::new('city')->setLabel('Ville'),
            AssociationField::new('compagny')->setLabel('Société'),
            AssociationField::new('user')->setLabel('Utilisateur'),
            AssociationField::new('location')->setLabel('Emplacement'),
            AssociationField::new('staff')->setLabel('Personnel'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des adresses')
            ->setPageTitle('detail', 'Détail de l\'adresse' )
            ->setPageTitle('edit', 'Modifier l\'adresse')
            ->setPageTitle('new', 'Créer une adresse');
    }
}

