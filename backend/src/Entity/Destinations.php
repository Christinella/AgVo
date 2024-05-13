<?php

namespace App\Entity;

use App\Repository\DestinationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: DestinationsRepository::class)]
class Destinations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_destinations_index',])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_destinations_index',])]
    private ?string $nom = null;


    #[ORM\Column(length: 255)]
    #[Groups(['api_destinations_index',])]
    private ?string $image = null;

    #[ORM\Column]
    #[Groups(['api_destinations_index',])]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_destinations_index',])]
    private ?string $categorie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['api_destinations_index',])]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['api_destinations_index',])]
    private ?\DateTimeInterface $dateArrivee = null;

    #[ORM\ManyToOne(inversedBy: 'Destinations')]
    #[Groups(['api_destinations_index',])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'destinations')]
    #[Groups(['api_destinations_index',])]
    private ?Pays $Pays = null;

    /**
     * @var Collection<int, Categories>
     */
    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'destinations')]
    private Collection $Categorie;

    /**
     * @var Collection<int, FormReservation>
     */
    #[ORM\OneToMany(targetEntity: FormReservation::class, mappedBy: 'destinations')]
    private Collection $FormRservation;

    public function __construct()
    {
        $this->Categorie = new ArrayCollection();
        $this->FormRservation = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTimeInterface $dateArrivee): static
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->Pays;
    }

    public function setPays(?Pays $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function addCategorie(Categories $categorie): static
    {
        if (!$this->Categorie->contains($categorie)) {
            $this->Categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categories $categorie): static
    {
        $this->Categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, FormReservation>
     */
    public function getFormRservation(): Collection
    {
        return $this->FormRservation;
    }

    public function addFormRservation(FormReservation $formRservation): static
    {
        if (!$this->FormRservation->contains($formRservation)) {
            $this->FormRservation->add($formRservation);
            $formRservation->setDestinations($this);
        }

        return $this;
    }

    public function removeFormRservation(FormReservation $formRservation): static
    {
        if ($this->FormRservation->removeElement($formRservation)) {
            // set the owning side to null (unless already changed)
            if ($formRservation->getDestinations() === $this) {
                $formRservation->setDestinations(null);
            }
        }

        return $this;
    }
}
