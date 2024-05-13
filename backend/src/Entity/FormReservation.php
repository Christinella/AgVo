<?php

namespace App\Entity;

use App\Repository\FormReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FormReservationRepository::class)]
class FormReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_FormReservation_index',])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_FormReservation_index',])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'FormRservation')]
    #[Groups(['api_FormReservation_index',])]
    private ?Destinations $destinations = null;

    #[ORM\ManyToOne(inversedBy: 'formReservations')]
    #[Groups(['api_FormReservation_index',])]
    private ?Statut $Statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDestinations(): ?Destinations
    {
        return $this->destinations;
    }

    public function setDestinations(?Destinations $destinations): static
    {
        $this->destinations = $destinations;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->Statut;
    }

    public function setStatut(?Statut $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
    }
}
