<?php

namespace App\Controller;

use App\Entity\FormReservation;
use App\Form\FormReservationType;
use App\Repository\FormReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/form/reservation')]
class FormReservationController extends AbstractController
{
    #[Route('/', name: 'app_form_reservation_index', methods: ['GET'])]
    public function index(FormReservationRepository $formReservationRepository): Response
    {
        return $this->render('form_reservation/index.html.twig', [
            'form_reservations' => $formReservationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_form_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formReservation = new FormReservation();
        $form = $this->createForm(FormReservationType::class, $formReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formReservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_form_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('form_reservation/new.html.twig', [
            'form_reservation' => $formReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_form_reservation_show', methods: ['GET'])]
    public function show(FormReservation $formReservation): Response
    {
        return $this->render('form_reservation/show.html.twig', [
            'form_reservation' => $formReservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_form_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FormReservation $formReservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormReservationType::class, $formReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_form_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('form_reservation/edit.html.twig', [
            'form_reservation' => $formReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_form_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, FormReservation $formReservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formReservation->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($formReservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_form_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
