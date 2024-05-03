<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    /**
     * @var Collection<int, FormReservation>
     */
    #[ORM\OneToMany(targetEntity: FormReservation::class, mappedBy: 'Statut')]
    private Collection $formReservations;

    /**
     * @var Collection<int, Contact>
     */
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'statut')]
    private Collection $contact;

    public function __construct()
    {
        $this->formReservations = new ArrayCollection();
        $this->contact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * @return Collection<int, FormReservation>
     */
    public function getFormReservations(): Collection
    {
        return $this->formReservations;
    }

    public function addFormReservation(FormReservation $formReservation): static
    {
        if (!$this->formReservations->contains($formReservation)) {
            $this->formReservations->add($formReservation);
            $formReservation->setStatut($this);
        }

        return $this;
    }

    public function removeFormReservation(FormReservation $formReservation): static
    {
        if ($this->formReservations->removeElement($formReservation)) {
            // set the owning side to null (unless already changed)
            if ($formReservation->getStatut() === $this) {
                $formReservation->setStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contact->contains($contact)) {
            $this->contact->add($contact);
            $contact->setStatut($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getStatut() === $this) {
                $contact->setStatut(null);
            }
        }

        return $this;
    }
}
