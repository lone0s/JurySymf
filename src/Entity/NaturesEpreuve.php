<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NaturesEpreuve
 *
 * @ORM\Table(name="natures_epreuve")
 * @ORM\Entity(repositoryClass="App\Repository\NaturesEpreuvesRepository")
 */
class NaturesEpreuve
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
     * @ORM\OneToMany(targetEntity=Epreuves::class, mappedBy="natureEpreuve")
     */
    private $epreuve;

    public function __construct()
    {
        $this->epreuve = new ArrayCollection();
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
     * @return Collection<int, Epreuves>
     */
    public function getEpreuve(): Collection
    {
        return $this->epreuve;
    }

    public function addIdEpreuve(Epreuves $idEpreuve): self
    {
        if (!$this->epreuve->contains($idEpreuve)) {
            $this->epreuve[] = $idEpreuve;
            $idEpreuve->setNatureEpreuve($this);
        }

        return $this;
    }

    public function removeIdEpreuve(Epreuves $idEpreuve): self
    {
        if ($this->epreuve->removeElement($idEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($idEpreuve->getNatureEpreuve() === $this) {
                $idEpreuve->setNatureEpreuve(null);
            }
        }

        return $this;
    }

}
