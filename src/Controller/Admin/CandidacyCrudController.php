<?php

namespace App\Controller\Admin;

use App\Entity\Candidacy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Controller\Admin\TypeCandidacyCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CandidacyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidacy::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('title')->setLabel('Titre'),
            TextEditorField::new('content')->setLabel('Contenu'),
            DateTimeField::new('created_at')->setLabel('Date de création'),
            DateTimeField::new('updated_at')->setLabel('Date de mise à jour'),
            AssociationField::new('type')->setLabel('Type de candidature'),
            AssociationField::new('status')->setLabel('Statut de candidature'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('created_by')->setLabel('Créé par'),
            AssociationField::new('comments')->setLabel('Commentaires'),
            AssociationField::new('documents')->setLabel('Documents'),
            AssociationField::new('staff')->setLabel('Personnel'),
            AssociationField::new('job')->setLabel('Emploi'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des candidatures')
            ->setPageTitle('detail', 'Détail de la candidature')
            ->setPageTitle('edit', 'Modifier la candidature')
            ->setPageTitle('new', 'Créer une candidature');
    }
}
