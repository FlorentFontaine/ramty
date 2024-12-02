<?php

namespace App\Controller\Admin;

use App\Entity\Alert;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class AlertCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alert::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            DateTimeField::new('alert_at')->setLabel('Date de l\'alerte'),
            TextEditorField::new('content')->setLabel('Contenu'),
            DateTimeField::new('created_at')->setLabel('Date de création'),
            DateTimeField::new('updated_at')->setLabel('Date de mise à jour'),
            AssociationField::new('type')->setLabel('Type d\'alerte'),
            AssociationField::new('status')->setLabel('Statut de l\'alerte'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('comments')->setLabel('Commentaires'),
            AssociationField::new('documents')->setLabel('Documents'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des alertes')
            ->setPageTitle('detail', 'Détail de l\'alerte')
            ->setPageTitle('edit', 'Modifier l\'alerte')
            ->setPageTitle('new', 'Créer une alerte');
    }
}
