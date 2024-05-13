<?php

namespace App\Controller\API;
use App\Entity\Destinations;
use App\Repository\DestinationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/destinations', name: 'api_destinations')]
class DestinationsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(DestinationsRepository $destinationsRepository): Response
    {
       $destinations= $destinationsRepository->findAll();
       return $this->json($destinations,context: ['groups' => 'api_destinations_index']);
    }

    #[Route('/{name}', name: 'show')]
    public function show(destinations $destinations): Response
    {
      
       return $this->json($destinations,context: ['groups' => [ 'api_destinations_show']]);
    }
}
