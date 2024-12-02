<?php

namespace App\Controller\Admin;

use App\Entity\Competence;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompetenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Competence::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name')->setLabel('Nom'),
            DateTimeField::new('created_at')->setLabel('Date de création'),
            DateTimeField::new('updated_at')->setLabel('Date de mise à jour')->onlyOnDetail(),
            AssociationField::new('type')->setLabel('Type de compétence'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Liste des compétences')
            ->setPageTitle('detail', 'Détail de la compétence')
            ->setPageTitle('edit', 'Modifier la compétence')
            ->setPageTitle('new', 'Créer une compétence');
    }
}

