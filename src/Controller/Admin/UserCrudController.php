<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};
use Symfony\Component\Form\FormEvent;


class UserCrudController extends AbstractCrudController
{
    public function __construct(
        public UserPasswordHasherInterface $userPasswordHasher
    ) {}
    
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('username')->setLabel('Nom d\'utilisateur'),
            EmailField::new('email')->setLabel('Email'),
            TextField::new('phone')->setLabel('Téléphone'),
            ArrayField::new('roles')->setLabel('Roles')->hideOnForm(),
            TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation du mot de passe'],
                'mapped' => false,
            ])
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms(),
            BooleanField::new('isVerified')->setLabel('Vérifié'),
            AssociationField::new('compagny')->setLabel('Compagnie'),
            AssociationField::new('addresses')->setLabel('Adresses'),
            AssociationField::new('alerts')->setLabel('Alertes'),
            AssociationField::new('candidacies')->setLabel('Candidatures'),
            AssociationField::new('comments')->setLabel('Commentaires'),
            AssociationField::new('documents')->setLabel('Documents'),
            AssociationField::new('events')->setLabel('Événements'),
            AssociationField::new('research')->setLabel('Recherches'),
            AssociationField::new('staff')->setLabel('Personnel'),
            AssociationField::new('steps')->setLabel('Étapes'),
            AssociationField::new('teams')->setLabel('Équipes'),
            AssociationField::new('events_assigned')->setLabel('Événements assignés'),
            AssociationField::new('eventTreateds')->setLabel('Événements traités'),
            AssociationField::new('preferenceUser')->setLabel('Préférences'),
            AssociationField::new('channels')->setLabel('Canaux'),
            // AssociationField::new('messageSends')->setLabel('Messages envoyés'),
            // AssociationField::new('messageReceives')->setLabel('Messages reçus'),
            ImageField::new('image')->setLabel('Image')->setBasePath('/uploads/images/')->onlyOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
            ->setSearchFields(['email', 'username']) // Champs à inclure dans la recherche
            ->setDefaultSort(['username' => 'ASC']) // Tri par défaut
            ->setPageTitle('index', 'Liste des utilisateurs')
            ->setPageTitle('new', 'Ajouter un nouvel utilisateur')
            ->setPageTitle('edit', 'Modifier l\'utilisateur')
            ->setPageTitle('detail', 'Détails de l\'utilisateur');
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            // Obtenez l'utilisateur actuel à partir des options du formulaire
            $options = $form->getConfig()->getOptions();
            $user = $options['data_class'];
            
            $hash = $this->userPasswordHasher->hashPassword($user, $password);
            $form->getData()->setPassword($hash);
        });
    }

    private function hashPassword() {
        return function($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $hash = $this->userPasswordHasher->hashPassword($this->getUser(), $password);
            $form->getData()->setPassword($hash);
        };
    }
}
