<?php

namespace App\Controller;

use Twig\Environment;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends AbstractController
{
    public function __construct(Environment $twig, private EventRepository $eventRepository)
    {
        $this->loader = $twig->getLoader();
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // si aucun utilisateur n'est connecté, on redirige vers la page de connexion
        // if (!$this->getUser()) {
        //     return $this->redirectToRoute('app_login');
        // }

        return $this->render('base.html.twig');
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function dasboard(): Response
    {
        $events = $this->eventRepository->findAll();

        return $this->render('/pages/home/dashboard.html.twig', [
            'events' => $events
        ]);
    }

    #[Route('components/{path}')]
    public function root($path)
    {
        if ($this->loader->exists('components/'.$path.'.html.twig')) {
            if ($path == '/' || $path == 'home') {
                die('Home');
            }
            return $this->render('components/'.$path.'.html.twig');
        }
        throw $this->createNotFoundException();
    }
}
