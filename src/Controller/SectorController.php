<?php

namespace App\Controller;

use App\Entity\Sector;
use App\Form\SectorType;
use App\Repository\SectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sector')]
class SectorController extends AbstractController
{
    #[Route('/', name: 'app_sector_index', methods: ['GET'])]
    public function index(Request $request, SectorRepository $sectorRepository, PaginatorInterface $paginator): Response
    {
        $sectors = $sectorRepository->findAll();

        $pagination = $paginator->paginate(
            $sectors,
            $request->query->getInt('page', 1),
            16
        );

        return $this->render('pages/sector/index.html.twig', [
            'data' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_sector_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sector = new Sector();
        $form = $this->createForm(SectorType::class, $sector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sector);
            $entityManager->flush();

            return $this->redirectToRoute('app_sector_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/sector/new.html.twig', [
            'sector' => $sector,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sector_show', methods: ['GET'])]
    public function show(Sector $sector): Response
    {
        return $this->render('pages/sector/show.html.twig', [
            'sector' => $sector,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sector_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sector $sector, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SectorType::class, $sector);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sector_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/sector/edit.html.twig', [
            'sector' => $sector,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sector_delete', methods: ['POST'])]
    public function delete(Request $request, Sector $sector, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sector->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sector);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sector_index', [], Response::HTTP_SEE_OTHER);
    }
}
