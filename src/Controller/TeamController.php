<?php
namespace App\Controller;

use App\Entity\Team;
use App\Controller\BaseController;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\SectorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/team')]
class TeamController extends BaseController
{
    private TeamRepository $teamRepository;
    private UserRepository $userRepository;
    private SectorRepository $sectorRepository;

    public function __construct(TeamRepository $teamRepository, UserRepository $userRepository, SectorRepository $sectorRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
        $this->sectorRepository = $sectorRepository;
    }

    #[Route('/', name: 'app_team_index', methods: ['GET', 'POST'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        if ($request->isMethod('POST')) {
            $this->add($request);
        }

        $teams = $this->teamRepository->findAll();
        $pagination = $paginator->paginate($teams, $request->query->getInt('page', 1), 8);

        return $this->render('pages/team/index.html.twig', [
            'teams' => $pagination,
            'users' => $this->userRepository->findAll(),
            'sectors' => $this->sectorRepository->findAll(),
        ]);
    }

    public function add(Request $request): void
    {
        // Ajout ou modification de l'équipe
        $team = $request->request->get('id') ? $this->teamRepository->find($request->request->get('id')) : new Team();
        $team->setName($request->request->get('name'));
        if ($request->request->get('image')) {
            $team->setImage($request->request->get('image'));
        }
        $team->setActive($request->request->get('active') === 'on');

        if($request->request->get('responsible')) {
            $responsible = $this->userRepository->find($request->request->get('responsible'));
            if ($responsible) {
                $team->setResponsible($responsible);
            }
        }
        
        $sectors = isset($_POST['sectors']) && $_POST['sectors'] ? (array) $_POST['sectors'] : [];
        if(!empty($sectors)) {
            foreach ($sectors as $sectorId) {
                $sector = $this->sectorRepository->find($sectorId);
                if ($sector) {
                    $team->addSector($sector);
                }
            }
        }

        $users = isset($_POST['users']) && $_POST['users'] ? (array) $_POST['users'] : [];

        if(!empty($users)) {
            foreach ($users as $userId) {
                $user = $this->userRepository->find($userId);
                if ($user) {
                    $team->addUser($user);
                }
            }
        }

        $this->saveEntity($team, $this->teamRepository);
        $this->redirectAfterAdd('app_team', $request->attributes->get('id'));
    }


    #[Route('/new', name: 'app_team_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/team/new.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_team_show', methods: ['GET'])]
    public function show(Team $team): Response
    {
        return $this->render('pages/team/show.html.twig', [
            'team' => $team,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_team_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/team/edit.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_team_delete', methods: ['POST'])]
    public function delete(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->request->get('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
    }
}
