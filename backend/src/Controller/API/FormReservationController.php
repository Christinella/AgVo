<?php

namespace App\Controller\API;
use App\Entity\FormReservation;
use App\Repository\FormReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/FormReservation', name: 'api_FormReservation')]
class FormReservationController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(FormReservationRepository $FormReservationRepository): Response
    {
       $FormReservation= $FormReservationRepository->findAll();
       return $this->json($FormReservation,context: ['groups' => 'api_FormReservation_index']);
    }

    #[Route('/{name}', name: 'show')]
    public function show(FormReservation $FormReservation): Response
    {
      
       return $this->json($FormReservation,context: ['groups' => [ 'api_FormReservation_show']]);
    }
}

