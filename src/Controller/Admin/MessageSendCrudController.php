<?php

namespace App\Controller\Admin;

use App\Entity\MessageSend;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MessageSendCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MessageSend::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            CollectionField::new('users')->setLabel('Utilisateurs'),
            CollectionField::new('messages')->setLabel('Messages'),
            DateTimeField::new('send_at')->setLabel('Envoyé le'),
            TextField::new('content')->setLabel('Contenu'),
            AssociationField::new('messageReceive')->setLabel('Message reçu'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Message envoyé')
            ->setEntityLabelInPlural('Messages envoyés')
            ->setDefaultSort(['send_at' => 'DESC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des messages envoyés')
            ->setPageTitle('new', 'Ajouter un nouveau message envoyé')
            ->setPageTitle('edit', 'Modifier le message envoyé')
            ->setPageTitle('detail', 'Détails du message envoyé');
    }
}
