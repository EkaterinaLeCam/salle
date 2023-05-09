<?php

namespace App\Entity;

use App\Repository\ErgonomieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ErgonomieRepository::class)]
class Ergonomie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Salle::class, mappedBy: 'equipement_ergonomie')]
    private Collection $salles_ergonomie;

    public function __construct()
    {
        $this->salles_ergonomie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Salle>
     */
    public function getSallesErgonomie(): Collection
    {
        return $this->salles_ergonomie;
    }

    public function addSallesErgonomie(Salle $sallesErgonomie): self
    {
        if (!$this->salles_ergonomie->contains($sallesErgonomie)) {
            $this->salles_ergonomie->add($sallesErgonomie);
            $sallesErgonomie->addEquipementErgonomie($this);
        }

        return $this;
    }

    public function removeSallesErgonomie(Salle $sallesErgonomie): self
    {
        if ($this->salles_ergonomie->removeElement($sallesErgonomie)) {
            $sallesErgonomie->removeEquipementErgonomie($this);
        }

        return $this;
    }
}
