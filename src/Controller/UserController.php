<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Controller\BaseController;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
class UserController extends BaseController
{
    private UserRepository $userRepository;
    private TeamRepository $teamRepository;
    private PaginatorInterface $paginator;

    public function __construct(UserRepository $userRepository, TeamRepository $teamRepository, PaginatorInterface $paginator)
    {
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->paginator = $paginator;
    }

    #[Route('/', name: 'app_user_index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $this->add($request);
        }

        $users = $this->userRepository->findAll();
        $teams = $this->teamRepository->findAll();
        // $pagination = $this->paginator->paginate($users, $request->query->getInt('page', 1), 10);

        return $this->render('pages/user/index.html.twig', [
            'users' => $users,
            'teams' => $teams,
        ]);
    }

    public function add(Request $request): void
    {
        $today = new \DateTimeImmutable();
        $userId = $request->request->get('id');
        
        $user = $userId ? $this->userRepository->find($userId) : new User();

        $this->saveEntity($user, $this->userRepository);
        $this->redirectAfterAdd('app_user', $request->attributes->get('id'));
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('pages/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($request->isMethod('POST')) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_show', ["id" => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/user/edit.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
