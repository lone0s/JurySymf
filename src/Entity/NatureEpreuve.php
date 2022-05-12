<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NatureEpreuve
 *
 * @ORM\Table(name="natures_epreuve")
 * @ORM\Entity(repositoryClass="App\Repository\NatureEpreuveRepository")
 */

// EVENTUELLEMENT METTRE NATURE EN UNIQUE ??
class NatureEpreuve
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
     * @ORM\Column(name="nature", type="string", length=50, nullable=false)
     */
    private $nature;

    /**
     * @ORM\OneToMany(targetEntity=Epreuve::class, mappedBy="natureEpreuve")
     */
    private $epreuves;


    // *******************************************************************
    public function __construct()
    {
        $this->epreuves = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * @return Collection<int, Epreuve>
     */
    public function getEpreuves(): Collection
    {
        return $this->epreuves;
    }

    public function addEpreuve(Epreuve $epreuve): self
    {
        if (!$this->epreuves->contains($epreuve)) {
            $this->epreuves[] = $epreuve;
            $epreuve->setNatureEpreuve($this);
        }

        return $this;
    }

    public function removeEpreuve(Epreuve $epreuve): self
    {
        if ($this->epreuves->removeElement($epreuve)) {
            // set the owning side to null (unless already changed)
            if ($epreuve->getNatureEpreuve() === $this) {
                $epreuve->setNatureEpreuve(null);
            }
        }

        return $this;
    }

    public function getIdFromName(string $name) {
        if ($name === $this -> nature) {
            return $this -> id;
        }
    }
}
