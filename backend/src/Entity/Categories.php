<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_categories_index',])]
    private ?string $nom = null;

    /**
     * @var Collection<int, Destinations>
     */
    #[ORM\ManyToMany(targetEntity: Destinations::class, mappedBy: 'Categorie')]
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
            $destination->addCategorie($this);
        }

        return $this;
    }

    public function removeDestination(Destinations $destination): static
    {
        if ($this->destinations->removeElement($destination)) {
            $destination->removeCategorie($this);
        }

        return $this;
    }
}
