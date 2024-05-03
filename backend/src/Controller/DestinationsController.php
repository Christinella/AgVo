<?php

namespace App\Controller;

use App\Entity\Destinations;
use App\Form\DestinationsType;
use App\Repository\DestinationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/destinations')]
class DestinationsController extends AbstractController
{
    #[Route('/', name: 'app_destinations_index', methods: ['GET'])]
    public function index(DestinationsRepository $destinationsRepository): Response
    {
        return $this->render('destinations/index.html.twig', [
            'destinations' => $destinationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_destinations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $destination = new Destinations();
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('app_destinations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('destinations/new.html.twig', [
            'destination' => $destination,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_destinations_show', methods: ['GET'])]
    public function show(Destinations $destination): Response
    {
        return $this->render('destinations/show.html.twig', [
            'destination' => $destination,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_destinations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Destinations $destination, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DestinationsType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_destinations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('destinations/edit.html.twig', [
            'destination' => $destination,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_destinations_delete', methods: ['POST'])]
    public function delete(Request $request, Destinations $destination, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destination->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($destination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_destinations_index', [], Response::HTTP_SEE_OTHER);
    }
}
