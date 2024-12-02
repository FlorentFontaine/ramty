<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('/planning', name: 'app_planning_index')]
    public function index(): Response
    {
        return $this->render('pages/planning/index.html.twig', [
            'controller_name' => 'PlanningController',
        ]);
    }
}
