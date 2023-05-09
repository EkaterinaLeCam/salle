<?php

namespace App\Entity;

use App\Repository\PreReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreReservationRepository::class)]
class PreReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column]
    private ?bool $validee = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'preReservations')]
    private Collection $utilisateur;

    #[ORM\ManyToOne(targetEntity: Salle::class, inversedBy: 'preReservations')]
    private Collection $salle;

    public function __construct()
    {
        $this->utilisateur = new ArrayCollection();
        $this->salle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function isValidee(): ?bool
    {
        return $this->validee;
    }

    public function setValidee(bool $validee): self
    {
        $this->validee = $validee;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur->add($utilisateur);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur->removeElement($utilisateur);

        return $this;
    }

    /**
     * @return Collection<int, Salle>
     */
    public function getSalle(): Collection
    {
        return $this->salle;
    }

    public function addSalle(Salle $salle): self
    {
        if (!$this->salle->contains($salle)) {
            $this->salle->add($salle);
        }

        return $this;
    }

    public function removeSalle(Salle $salle): self
    {
        $this->salle->removeElement($salle);

        return $this;
    }
}
