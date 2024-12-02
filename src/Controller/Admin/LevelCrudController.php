<?php

namespace App\Controller\Admin;

use App\Entity\Level;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LevelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Level::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('type')->setLabel('Type de niveau'),
            AssociationField::new('staff')->setLabel('Personnel'),
            AssociationField::new('competence')->setLabel('Compétence'),
            AssociationField::new('criteria')->setLabel('Critère'),
            AssociationField::new('tool')->setLabel('Outil'),
            AssociationField::new('sector')->setLabel('Secteur'),
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

