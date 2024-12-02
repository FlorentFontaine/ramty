<?php

namespace App\Controller\Admin;

use App\Entity\Chat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ChatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chat::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            CollectionField::new('channels')->setLabel('Canaux'),
            CollectionField::new('messages')->setLabel('Messages'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Messagerie')
            ->setEntityLabelInPlural('Messageries')
            ->setDefaultSort(['id' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des messageries')
            ->setPageTitle('new', 'Ajouter une nouvelle messagerie')
            ->setPageTitle('edit', 'Modifier la messagerie')
            ->setPageTitle('detail', 'Détails de la messagerie');
    }
}
