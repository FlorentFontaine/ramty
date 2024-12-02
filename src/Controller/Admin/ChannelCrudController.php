<?php

namespace App\Controller\Admin;

use App\Entity\Channel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChannelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Channel::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('chat')->setLabel('Messagerie'),
            AssociationField::new('members')->setLabel('Membres'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Canal')
            ->setEntityLabelInPlural('Canaux')
            ->setSearchFields(['name']) // Champs à inclure dans la recherche
            ->setDefaultSort(['name' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des canaux')
            ->setPageTitle('new', 'Ajouter un nouveau canal')
            ->setPageTitle('edit', 'Modifier le canal')
            ->setPageTitle('detail', 'Détails du canal');
    }
}
