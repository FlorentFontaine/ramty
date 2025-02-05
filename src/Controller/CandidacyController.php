<?php

namespace App\Controller;

use App\Entity\Candidacy;
use App\Form\CandidacyType;
use App\Repository\CandidacyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidacy')]
class CandidacyController extends AbstractController
{
    #[Route('/', name: 'app_candidacy_index', methods: ['GET'])]
    public function index(CandidacyRepository $candidacyRepository): Response
    {
        return $this->render('pages/candidacy/index.html.twig', [
            'candidacies' => $candidacyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_candidacy_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $candidacy = new Candidacy();
        $form = $this->createForm(CandidacyType::class, $candidacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($candidacy);
            $entityManager->flush();

            return $this->redirectToRoute('app_candidacy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/candidacy/new.html.twig', [
            'candidacy' => $candidacy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidacy_show', methods: ['GET'])]
    public function show(Candidacy $candidacy): Response
    {
        return $this->render('pages/candidacy/show.html.twig', [
            'candidacy' => $candidacy,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_candidacy_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidacy $candidacy, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CandidacyType::class, $candidacy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_candidacy_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/candidacy/edit.html.twig', [
            'candidacy' => $candidacy,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidacy_delete', methods: ['POST'])]
    public function delete(Request $request, Candidacy $candidacy, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidacy->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidacy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidacy_index', [], Response::HTTP_SEE_OTHER);
    }
}
