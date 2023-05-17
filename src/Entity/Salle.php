<?php

namespace App\Entity;
use App\Controller\SalleController;
use App\Repository\SalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleRepository::class)]
class Salle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column]
    private ?bool $estAccessiblePMP = null;

    #[ORM\OneToMany(targetEntity: PreReservation::class, mappedBy: 'salle')]
    private Collection $preReservations;

    #[ORM\ManyToMany(targetEntity: Materiel::class, inversedBy: 'salles_materiel')]
    private Collection $equipement_materiel;

    #[ORM\ManyToMany(targetEntity: Logiciel::class, inversedBy: 'salles_logiciel')]
    private Collection $equipement_logiciel;

    #[ORM\ManyToMany(targetEntity: Ergonomie::class, inversedBy: 'salles_ergonomie')]
    private Collection $equipement_ergonomie;

    public function __construct()
    {
        $this->preReservations = new ArrayCollection();
        $this->equipement_materiel = new ArrayCollection();
        $this->equipement_logiciel = new ArrayCollection();
        $this->equipement_ergonomie = new ArrayCollection();
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

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function isEstAccessiblePMP(): ?bool
    {
        return $this->estAccessiblePMP;
    }

    public function setEstAccessiblePMP(bool $estAccessiblePMP): self
    {
        $this->estAccessiblePMP = $estAccessiblePMP;

        return $this;
    }

    /**
     * @return Collection<int, PreReservation>
     */
    public function getPreReservations(): Collection
    {
        return $this->preReservations;
    }

    public function addPreReservation(PreReservation $preReservation): self
    {
        if (!$this->preReservations->contains($preReservation)) {
            $this->preReservations->add($preReservation);
            $preReservation->addSalle($this);
            $preReservation->setIdSalle($this);
            }
    
            return $this;
        }

      
    

    public function removePreReservation(PreReservation $preReservation): self
    {
        if ($this->preReservations->removeElement($preReservation)) {
            $preReservation->removeSalle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Materiel>
     */
    public function getEquipementMateriel(): Collection
    {
        return $this->equipement_materiel;
    }

    public function addEquipementMateriel(Materiel $equipementMateriel): self
    {
        if (!$this->equipement_materiel->contains($equipementMateriel)) {
            $this->equipement_materiel->add($equipementMateriel);
        }

        return $this;
    }

    public function removeEquipementMateriel(Materiel $equipementMateriel): self
    {
        $this->equipement_materiel->removeElement($equipementMateriel);

        return $this;
    }

    /**
     * @return Collection<int, Logiciel>
     */
    public function getEquipementLogiciel(): Collection
    {
        return $this->equipement_logiciel;
    }

    public function addEquipementLogiciel(Logiciel $equipementLogiciel): self
    {
        if (!$this->equipement_logiciel->contains($equipementLogiciel)) {
            $this->equipement_logiciel->add($equipementLogiciel);
        }

        return $this;
    }

    public function removeEquipementLogiciel(Logiciel $equipementLogiciel): self
    {
        $this->equipement_logiciel->removeElement($equipementLogiciel);

        return $this;
    }

    /**
     * @return Collection<int, Ergonomie>
     */
    public function getEquipementErgonomie(): Collection
    {
        return $this->equipement_ergonomie;
    }

    public function addEquipementErgonomie(Ergonomie $equipementErgonomie): self
    {
        if (!$this->equipement_ergonomie->contains($equipementErgonomie)) {
            $this->equipement_ergonomie->add($equipementErgonomie);
        }

        return $this;
    }

    public function removeEquipementErgonomie(Ergonomie $equipementErgonomie): self
    {
        $this->equipement_ergonomie->removeElement($equipementErgonomie);

        return $this;
    }
}
