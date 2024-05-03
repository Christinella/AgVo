<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Destinations>
     */
    #[ORM\OneToMany(targetEntity: Destinations::class, mappedBy: 'Pays')]
    private Collection $destinations;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Destinations>
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Destinations $destination): static
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations->add($destination);
            $destination->setPays($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): static
    {
        if ($this->destinations->removeElement($destination)) {
            // set the owning side to null (unless already changed)
            if ($destination->getPays() === $this) {
                $destination->setPays(null);
            }
        }

        return $this;
    }
}
