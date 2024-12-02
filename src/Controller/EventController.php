<?php
namespace App\Controller;

use App\Entity\Event;
use App\Controller\BaseController;
use App\Repository\UserRepository;
use App\Repository\EventRepository;
use App\Repository\StaffRepository;
use App\Repository\PriorityRepository;
use App\Repository\TypeEventRepository;
use App\Repository\TypeStaffRepository;
use App\Repository\StatusEventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends BaseController
{
    private EventRepository $eventRepository;
    private UserRepository $userRepository;
    private StaffRepository $staffRepository;
    private PriorityRepository $priorityRepository;
    private TypeEventRepository $typeEventRepository;
    private TypeStaffRepository $typeStaffRepository;
    private StatusEventRepository $statusEventRepository;
    private PaginatorInterface $paginator;

    public function __construct(
        EventRepository $eventRepository,
        UserRepository $userRepository,
        StaffRepository $staffRepository,
        PriorityRepository $priorityRepository,
        TypeEventRepository $typeEventRepository,
        TypeStaffRepository $typeStaffRepository,
        StatusEventRepository $statusEventRepository,
        PaginatorInterface $paginator
    ) {
        $this->eventRepository = $eventRepository;
        $this->userRepository = $userRepository;
        $this->staffRepository = $staffRepository;
        $this->priorityRepository = $priorityRepository;
        $this->typeEventRepository = $typeEventRepository;
        $this->typeStaffRepository = $typeStaffRepository;
        $this->statusEventRepository = $statusEventRepository;
        $this->paginator = $paginator;
    }

    #[Route('/', name: 'app_event_index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $this->add($request);
        }

        $events = $this->eventRepository->findAll();
        $pagination = $this->paginator->paginate($events, $request->query->getInt('page', 1), 10);

        return $this->render('pages/event/index.html.twig', [
            'events' => $pagination,
            'users' => $this->userRepository->findAll(),
            'typeStaffs' => $this->typeStaffRepository->findAll(),
            'statusEvents' => $this->statusEventRepository->findAll(),
            'typeEvents' => $this->typeEventRepository->findAll(),
            'priorities' => $this->priorityRepository->findAll(),
        ]);
    }

    #[Route('/show/{id}', name: 'app_event_show', methods: ['GET', 'POST'])]
    public function show(Event $event, Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $this->add($request);
        }

        return $this->render('pages/event/show.html.twig', [
            'event' => $event,
            'users' => $this->userRepository->findAll(),
            'typeStaffs' => $this->typeStaffRepository->findAll(),
            'statusEvents' => $this->statusEventRepository->findAll(),
            'typeEvents' => $this->typeEventRepository->findAll(),
            'priorities' => $this->priorityRepository->findAll(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $this->eventRepository->remove($event, true);
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }

    public function add(Request $request): void
    {
        $today = new \DateTimeImmutable();
        $eventId = $request->request->get('id');
        
        $event = $eventId ? $this->eventRepository->find($eventId) : new Event();
        $event->setTitle($request->request->get('title'));
        $event->setContent($request->request->get('content'));
        $event->setUpdatedAt($today);

        if (!$eventId) {
            $event->setCreatedAt($today);
        }

        $dueDateString = $request->request->get('due_date_at');
        $dueDate = \DateTimeImmutable::createFromFormat('Y-m-d', $dueDateString);

        if ($dueDate === false) {
            throw new \InvalidArgumentException('Invalid due date format');
        }
        $event->setDueDateAt($dueDate);
        
        $event->setType($this->typeEventRepository->find($request->request->get('type')));
        $event->setPriority($this->priorityRepository->find($request->request->get('priority')));
        $event->setStatus($this->statusEventRepository->find($request->request->get('status')));
        $event->setAttached($this->staffRepository->find($request->request->get('attached')));
        $event->setCreatedBy($this->getUser());
        $event->setPeriod(false);

        $assignedUsers = isset($_POST['assigned']) && $_POST['assigned'] ? (array) $_POST['assigned'] : [];
        if(!empty($assignedUsers)) {
            foreach ($assignedUsers as $userId) {
                $user = $this->userRepository->find(intval($userId));
                if ($user) {
                    $event->addAssigned($user);
                }
            }
        }

        $this->saveEntity($event, $this->eventRepository);
        $this->redirectAfterAdd('app_event', $request->attributes->get('id'));
    }
}
