<?php

namespace App\Controller;


use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Repository\StaffRepository;
use App\Repository\PriorityRepository;
use App\Repository\TypeEventRepository;
use App\Repository\TypeStaffRepository;
use App\Repository\StatusEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/calendar')]
class CalendarController extends AbstractController
{
    public function __construct(
        private EventRepository $eventRepository,
        private UserRepository $userRepository,
        private StaffRepository $staffRepository,
        private PriorityRepository $priorityRepository,
        private TypeEventRepository $typeEventRepository,
        private TypeStaffRepository $typeStaffRepository,
        private StatusEventRepository $statusEventRepository
    ) {
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
        $this->staffRepository = $staffRepository;
        $this->priorityRepository = $priorityRepository;
        $this->typeEventRepository = $typeEventRepository;
        $this->typeStaffRepository = $typeStaffRepository;
        $this->statusEventRepository = $statusEventRepository;
    }

    #[Route('/', name: 'app_calendar_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        return $this->render('pages/calendar/index.html.twig', [
            'events' => $this->eventRepository->findAll(),
            'users' => $this->userRepository->findAll(),
            'typeStaffs' => $this->typeStaffRepository->findAll(),
            'statusEvents' => $this->statusEventRepository->findAll(),
            'typeEvents' => $this->typeEventRepository->findAll(),
            'priorities' => $this->priorityRepository->findAll(),
        ]);
    }
}



