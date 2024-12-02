<?php

namespace App\Controller\Admin;

use App\Entity\MessageReceive;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class MessageReceiveCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MessageReceive::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('users')->setLabel('Utilisateurs'),
            AssociationField::new('messages')->setLabel('Messages'),
            BooleanField::new('view')->setLabel('Vu'),
            AssociationField::new('message_send')->setLabel('Message envoyé'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Message reçu')
            ->setEntityLabelInPlural('Messages reçus')
            ->setDefaultSort(['id' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des messages reçus')
            ->setPageTitle('new', 'Ajouter un nouveau message reçu')
            ->setPageTitle('edit', 'Modifier le message reçu')
            ->setPageTitle('detail', 'Détails du message reçu');
    }
}
