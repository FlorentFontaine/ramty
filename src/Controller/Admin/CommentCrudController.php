<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextEditorField::new('content')->setLabel('Contenu'),
            DateTimeField::new('created_at')->setLabel('Date de création'),
            DateTimeField::new('updated_at')->setLabel('Date de mise à jour'),
            AssociationField::new('alert')->setLabel('Alerte associée'),
            AssociationField::new('candidacy')->setLabel('Candidature associée'),
            AssociationField::new('event')->setLabel('Événement associé'),
            AssociationField::new('step')->setLabel('Étape associée'),
            AssociationField::new('job')->setLabel('Emploi associé'),
            AssociationField::new('document')->setLabel('Document associé'),
            AssociationField::new('research')->setLabel('Recherche associée'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('staff')->setLabel('Personnel associé'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des commentaires')
            ->setPageTitle('detail', 'Détail du commentaire')
            ->setPageTitle('edit', 'Modifier le commentaire')
            ->setPageTitle('new', 'Créer un commentaire');
    }
}
