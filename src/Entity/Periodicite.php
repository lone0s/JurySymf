<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Periodicite
 *
 * @ORM\Table(name="periodicites")
 * @ORM\Entity(repositoryClass="App\Repository\PeriodiciteRepository")
 */
class Periodicite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_court", type="string", length=10, nullable=false)
     */
    private $nomCourt;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre", type="integer", nullable=false, options={"comment"="nombre de sous-périodes dans l'annéee"})
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Parcour::class, mappedBy="periodicite")
     */
    private $parcours;


    // *******************************************************************
    public function __construct()
    {
        $this->parcours = new ArrayCollection();
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

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Parcour>
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcour(Parcour $parcour): self
    {
        if (!$this->parcours->contains($parcour)) {
            $this->parcours[] = $parcour;
            $parcour->setPeriodicite($this);
        }

        return $this;
    }

    public function removeParcour(Parcour $parcour): self
    {
        if ($this->parcours->removeElement($parcour)) {
            // set the owning side to null (unless already changed)
            if ($parcour->getPeriodicite() === $this) {
                $parcour->setPeriodicite(null);
            }
        }

        return $this;
    }

}
