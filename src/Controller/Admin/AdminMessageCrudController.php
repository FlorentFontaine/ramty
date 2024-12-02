<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class AdminMessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('chat')->setLabel('Messagerie'),
            CollectionField::new('messageSends')->setLabel('Messages envoyés'),
            CollectionField::new('messageReceives')->setLabel('Messages reçus'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Message')
            ->setEntityLabelInPlural('Messages')
            ->setDefaultSort(['id' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des messages')
            ->setPageTitle('new', 'Ajouter un nouveau message')
            ->setPageTitle('edit', 'Modifier le message')
            ->setPageTitle('detail', 'Détails du message');
    }
}
