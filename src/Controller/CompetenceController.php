<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use App\Repository\TypeCompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/competence')]
class CompetenceController extends AbstractController
{
    #[Route('/', name: 'app_competence_index', methods: ['GET'])]
    public function index(Request $request, CompetenceRepository $competenceRepository, PaginatorInterface $paginator, TypeCompetenceRepository $typeCompetenceRepository): Response
    {
        $competences = $competenceRepository->findAll();

        $pagination = $paginator->paginate(
            $competences,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/competence/index.html.twig', [
            'data' => $pagination,
            'type' => $typeCompetenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_competence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($competence);
            $entityManager->flush();

            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/competence/new.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competence_show', methods: ['GET'])]
    public function show(Competence $competence): Response
    {
        return $this->render('pages/competence/show.html.twig', [
            'competence' => $competence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_competence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competence $competence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/competence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competence_delete', methods: ['POST'])]
    public function delete(Request $request, Competence $competence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $entityManager->remove($competence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
    }
}
