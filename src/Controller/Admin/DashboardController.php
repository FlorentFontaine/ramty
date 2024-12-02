<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AddressCrudController;
use App\Controller\Admin\AdminMessageCrudController;
use App\Controller\Admin\AlertCrudController;
use App\Controller\Admin\CandidacyCrudController;
use App\Controller\Admin\ChannelCrudController;
use App\Controller\Admin\ChatCrudController;
use App\Controller\Admin\CityCrudController;
use App\Controller\Admin\CommentCrudController;
use App\Controller\Admin\CompagnyCrudController;
use App\Controller\Admin\CompetenceCrudController;
use App\Controller\Admin\ConfigResearchCrudController;
use App\Controller\Admin\CountryCrudController;
use App\Controller\Admin\CriteriaCrudController;
use App\Controller\Admin\DocumentCrudController;
use App\Controller\Admin\EventCrudController;
use App\Controller\Admin\EventTreatedCrudController;
use App\Controller\Admin\FieldCrudController;
use App\Controller\Admin\ImageCrudController;
use App\Controller\Admin\JobCrudController;
use App\Controller\Admin\LevelCrudController;
use App\Controller\Admin\LocationCrudController;
use App\Controller\Admin\MessageReceiveCrudController;
use App\Controller\Admin\MessageSendCrudController;
use App\Controller\Admin\PlatformCrudController;
use App\Controller\Admin\PreferenceUserCrudController;
use App\Controller\Admin\PriorityCrudController;
use App\Controller\Admin\ResearchCrudController;
use App\Controller\Admin\SectorCrudController;
use App\Controller\Admin\StaffCrudController;
use App\Controller\Admin\StatusAlertCrudController;
use App\Controller\Admin\StatusCandidacyCrudController;
use App\Controller\Admin\StatusEventCrudController;
use App\Controller\Admin\StatusJobCrudController;
use App\Controller\Admin\StatusStepCrudController;
use App\Controller\Admin\StepCrudController;
use App\Controller\Admin\TaskCrudController;
use App\Controller\Admin\TeamCrudController;
use App\Controller\Admin\ToolCrudController;
use App\Controller\Admin\TypeAlertCrudController;
use App\Controller\Admin\TypeCandidacyCrudController;
use App\Controller\Admin\TypeCompetenceCrudController;
use App\Controller\Admin\TypeConfigResearchCrudController;
use App\Controller\Admin\TypeCriteriaCrudController;
use App\Controller\Admin\TypeDocumentCrudController;
use App\Controller\Admin\TypeEventCrudController;
use App\Controller\Admin\TypeJobCrudController;
use App\Controller\Admin\TypeResearchCrudController;
use App\Controller\Admin\TypeStaffCrudController;
use App\Controller\Admin\TypeStepCrudController;
use App\Controller\Admin\TypeTaskCrudController;
use App\Controller\Admin\UserCrudController;
use App\Entity\Address;
use App\Entity\Alert;
use App\Entity\Board;
use App\Entity\Candidacy;
use App\Entity\Channel;
use App\Entity\Chat;
use App\Entity\City;
use App\Entity\Comment;
use App\Entity\Compagny;
use App\Entity\Competence;
use App\Entity\ConfigResearch;
use App\Entity\Country;
use App\Entity\Criteria;
use App\Entity\Document;
use App\Entity\Event;
use App\Entity\EventTreated;
use App\Entity\Field;
use App\Entity\Image;
use App\Entity\Job;
use App\Entity\Level;
use App\Entity\Location;
use App\Entity\Message;
use App\Entity\MessageReceive;
use App\Entity\MessageSend;
use App\Entity\Platform;
use App\Entity\PreferenceUser;
use App\Entity\Priority;
use App\Entity\Research;
use App\Entity\Sector;
use App\Entity\Staff;
use App\Entity\StatusAlert;
use App\Entity\StatusCandidacy;
use App\Entity\StatusEvent;
use App\Entity\StatusJob;
use App\Entity\StatusStep;
use App\Entity\Step;
use App\Entity\Task;
use App\Entity\Team;
use App\Entity\Tool;
use App\Entity\TypeAlert;
use App\Entity\TypeCandidacy;
use App\Entity\TypeCompetence;
use App\Entity\TypeConfigResearch;
use App\Entity\TypeCriteria;
use App\Entity\TypeDocument;
use App\Entity\TypeEvent;
use App\Entity\TypeJob;
use App\Entity\TypeResearch;
use App\Entity\TypeStaff;
use App\Entity\TypeStep;
use App\Entity\TypeTask;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
    }
    
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig',[
            'nbUser'=>$this->userRepository->count([]),
            'users'=>$this->userRepository->findAll()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<a href="/">KONEXTY</a>');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            // this defines the pagination size for all CRUD controllers
            // (each CRUD controller can override this value if needed)
            ->setPaginatorPageSize(30)
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Données utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class)->setController(UserCrudController::class);
        yield MenuItem::linkToCrud('Préférence utilisateurs', 'fas fa-cogs', PreferenceUser::class)->setController(PreferenceUserCrudController::class);
        yield MenuItem::linkToCrud('Équipes', 'fas fa-users', Team::class)->setController(TeamCrudController::class);

        yield MenuItem::section('Données entreprises');
        yield MenuItem::linkToCrud('Compagnies', 'fas fa-building', Compagny::class)->setController(CompagnyCrudController::class);
        yield MenuItem::linkToCrud('Sites', 'fas fa-hotel', Location::class)->setController(LocationCrudController::class);

        // Sous-menu pour Données personnels
        yield MenuItem::subMenu('Données personnels', 'fas fa-user')
            ->setSubItems([
                MenuItem::linkToCrud('Personnel', 'fas fa-user', Staff::class)->setController(StaffCrudController::class),
                MenuItem::linkToCrud('Plateforme', 'fas fa-laptop', Platform::class)->setController(PlatformCrudController::class),
                MenuItem::linkToCrud('Niveaux', 'fas fa-level-up-alt', Level::class)->setController(LevelCrudController::class),
            ]);

        // Sous-menu pour Données événements
        yield MenuItem::subMenu('Données événements', 'fas fa-calendar-alt')
            ->setSubItems([
                MenuItem::linkToCrud('Événements', 'fas fa-calendar-alt', Event::class)->setController(EventCrudController::class),
                MenuItem::linkToCrud('Traitement', 'fas fa-cogs', EventTreated::class)->setController(EventTreatedCrudController::class),
                MenuItem::linkToCrud('Tableaux', 'fas fa-columns', Board::class)->setController(BoardCrudController::class),
                MenuItem::linkToCrud('Tâches', 'fas fa-tasks', Task::class)->setController(TaskCrudController::class),
                MenuItem::linkToCrud('Étapes', 'fas fa-list-ol', Step::class)->setController(StepCrudController::class),
                MenuItem::linkToCrud('Alertes', 'fas fa-exclamation-triangle', Alert::class)->setController(AlertCrudController::class),
                MenuItem::linkToCrud('Priorités', 'fas fa-flag', Priority::class)->setController(PriorityCrudController::class),
            ]);


        // Sous-menu pour Données métiers
        yield MenuItem::subMenu('Données métiers', 'fas fa-briefcase')
            ->setSubItems([
                MenuItem::linkToCrud('Métiers', 'fas fa-briefcase', Job::class)->setController(JobCrudController::class),
                MenuItem::linkToCrud('Candidatures', 'fas fa-file-alt', Candidacy::class)->setController(CandidacyCrudController::class),
            ]);

        // Sous-menu pour Données recherches
        yield MenuItem::subMenu('Données recherches', 'fas fa-search')
            ->setSubItems([
                MenuItem::linkToCrud('Recherches', 'fas fa-search', Research::class)->setController(ResearchCrudController::class),
                MenuItem::linkToCrud('Champs', 'fas fa-th-list', Field::class)->setController(FieldCrudController::class),
                MenuItem::linkToCrud('Configuration', 'fas fa-cogs', ConfigResearch::class)->setController(ConfigResearchCrudController::class),
            ]);

        // Sous-menu pour Données spécificitées
        yield MenuItem::subMenu('Données spécificités', 'fas fa-cogs')
            ->setSubItems([
                MenuItem::linkToCrud('Secteurs', 'fas fa-industry', Sector::class)->setController(SectorCrudController::class),
                MenuItem::linkToCrud('Compétences', 'fas fa-certificate', Competence::class)->setController(CompetenceCrudController::class),
                MenuItem::linkToCrud('Outils', 'fas fa-toolbox', Tool::class)->setController(ToolCrudController::class),
                MenuItem::linkToCrud('Critères', 'fas fa-check-circle', Criteria::class)->setController(CriteriaCrudController::class)
            ]);

            yield MenuItem::subMenu('Données Messagerie', 'fas fa-envelope')
            ->setSubItems([
                MenuItem::linkToCrud('Messagerie', 'fas fa-comments', Chat::class)->setController(ChatCrudController::class),
                MenuItem::linkToCrud('Canaux', 'fas fa-broadcast-tower', Channel::class)->setController(ChannelCrudController::class),
                MenuItem::linkToCrud('Messages', 'fas fa-comment-alt', Message::class)->setController(AdminMessageCrudController::class),
                MenuItem::linkToCrud('Messages envoyés', 'fas fa-paper-plane', MessageSend::class)->setController(MessageSendCrudController::class),
                MenuItem::linkToCrud('Messages reçus', 'fas fa-inbox', MessageReceive::class)->setController(MessageReceiveCrudController::class),
            ]);

        // Sous-menu pour Données communes
        yield MenuItem::subMenu('Données communes', 'fas fa-archive')
            ->setSubItems([
                MenuItem::linkToCrud('Adresses', 'fas fa-map-marker-alt', Address::class)->setController(AddressCrudController::class),
                MenuItem::linkToCrud('Villes', 'fas fa-city', City::class)->setController(CityCrudController::class),
                MenuItem::linkToCrud('Pays', 'fas fa-globe', Country::class)->setController(CountryCrudController::class),
                MenuItem::linkToCrud('Documents', 'fas fa-file', Document::class)->setController(DocumentCrudController::class),
                MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comment::class)->setController(CommentCrudController::class),
                MenuItem::linkToCrud('Images', 'fas fa-camera', Image::class)->setController(ImageCrudController::class),
            ]);

        // Sous-menu pour Données status
        yield MenuItem::subMenu('Données status', 'fas fa-info-circle')
            ->setSubItems([
                MenuItem::linkToCrud('Événements', 'fas fa-calendar-alt', StatusEvent::class)->setController(StatusEventCrudController::class),
                MenuItem::linkToCrud('Étapes', 'fas fa-list-ol', StatusStep::class)->setController(StatusStepCrudController::class),
                MenuItem::linkToCrud('Alertes', 'fas fa-exclamation-triangle', StatusAlert::class)->setController(StatusAlertCrudController::class),
                MenuItem::linkToCrud('Métier', 'fas fa-briefcase', StatusJob::class)->setController(StatusJobCrudController::class),
                MenuItem::linkToCrud('Candidatures', 'fas fa-file-alt', StatusCandidacy::class)->setController(StatusCandidacyCrudController::class),
            ]);

        // Sous-menu pour Données Types
        yield MenuItem::subMenu('Données Types', 'fas fa-cogs')
            ->setSubItems([
                MenuItem::linkToCrud('Alertes', 'fas fa-exclamation-triangle', TypeAlert::class)->setController(TypeAlertCrudController::class),
                MenuItem::linkToCrud('Candidatures', 'fas fa-file-alt', TypeCandidacy::class)->setController(TypeCandidacyCrudController::class),
                MenuItem::linkToCrud('Compétences', 'fas fa-certificate', TypeCompetence::class)->setController(TypeCompetenceCrudController::class),
                MenuItem::linkToCrud('Configurations de recherches', 'fas fa-cogs', TypeConfigResearch::class)->setController(TypeConfigResearchCrudController::class),
                MenuItem::linkToCrud('Critères', 'fas fa-check-circle', TypeCriteria::class)->setController(TypeCriteriaCrudController::class),
                MenuItem::linkToCrud('Documents', 'fas fa-file', TypeDocument::class)->setController(TypeDocumentCrudController::class),
                MenuItem::linkToCrud('Événements', 'fas fa-calendar-alt', TypeEvent::class)->setController(TypeEventCrudController::class),
                MenuItem::linkToCrud('Tâches', 'fas fa-tasks', TypeTask::class)->setController(TypeTaskCrudController::class),
                MenuItem::linkToCrud('Métiers', 'fas fa-briefcase', TypeJob::class)->setController(TypeJobCrudController::class),
                MenuItem::linkToCrud('Recherches', 'fas fa-search', TypeResearch::class)->setController(TypeResearchCrudController::class),
                MenuItem::linkToCrud('Personnels', 'fas fa-user', TypeStaff::class)->setController(TypeStaffCrudController::class),
                MenuItem::linkToCrud('Étapes', 'fas fa-list-ol', TypeStep::class)->setController(TypeStepCrudController::class),
                MenuItem::linkToCrud('Niveaux', 'fas fa-level-up-alt', Level::class)->setController(TypeLevelCrudController::class),
            ]);

    }
}
