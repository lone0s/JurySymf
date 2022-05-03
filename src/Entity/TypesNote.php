<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypesNote
 *
 * @ORM\Table(name="types_note", uniqueConstraints={@ORM\UniqueConstraint(name="type_UNIQUE", columns={"type"})})
 * @ORM\Entity(repositoryClass="App\Repository\TypesNoteRepository")
 */
class TypesNote
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
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="typeNote")
     */
    private $inscriptionParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="typeNote")
     */
    private $inscriptionPeriode;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="typeNote")
     */
    private $inscriptionUe;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsEpreuves::class, mappedBy="typeNote")
     */
    private $inscriptionEpreuve;

    public function __construct()
    {
        $this->inscriptionParcours = new ArrayCollection();
        $this->inscriptionPeriode = new ArrayCollection();
        $this->inscriptionUe = new ArrayCollection();
        $this->inscriptionEpreuve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsParcours>
     */
    public function getInscriptionParcours(): Collection
    {
        return $this->inscriptionParcours;
    }

    public function addIdInscriptionParcour(InscriptionsParcours $idInscriptionParcour): self
    {
        if (!$this->inscriptionParcours->contains($idInscriptionParcour)) {
            $this->inscriptionParcours[] = $idInscriptionParcour;
            $idInscriptionParcour->setTypeNote($this);
        }

        return $this;
    }

    public function removeIdInscriptionParcour(InscriptionsParcours $idInscriptionParcour): self
    {
        if ($this->inscriptionParcours->removeElement($idInscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionParcour->getTypeNote() === $this) {
                $idInscriptionParcour->setTypeNote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsPeriodes>
     */
    public function getInscriptionPeriode(): Collection
    {
        return $this->inscriptionPeriode;
    }

    public function addIdInscriptionPeriode(InscriptionsPeriodes $idInscriptionPeriode): self
    {
        if (!$this->inscriptionPeriode->contains($idInscriptionPeriode)) {
            $this->inscriptionPeriode[] = $idInscriptionPeriode;
            $idInscriptionPeriode->setTypeNote($this);
        }

        return $this;
    }

    public function removeIdInscriptionPeriode(InscriptionsPeriodes $idInscriptionPeriode): self
    {
        if ($this->inscriptionPeriode->removeElement($idInscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionPeriode->getTypeNote() === $this) {
                $idInscriptionPeriode->setTypeNote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsUes>
     */
    public function getInscriptionUe(): Collection
    {
        return $this->inscriptionUe;
    }

    public function addIdInscriptionUe(InscriptionsUes $idInscriptionUe): self
    {
        if (!$this->inscriptionUe->contains($idInscriptionUe)) {
            $this->inscriptionUe[] = $idInscriptionUe;
            $idInscriptionUe->setTypeNote($this);
        }

        return $this;
    }

    public function removeIdInscriptionUe(InscriptionsUes $idInscriptionUe): self
    {
        if ($this->inscriptionUe->removeElement($idInscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionUe->getTypeNote() === $this) {
                $idInscriptionUe->setTypeNote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsEpreuves>
     */
    public function getInscriptionEpreuve(): Collection
    {
        return $this->inscriptionEpreuve;
    }

    public function addIdInscriptionEpreuve(InscriptionsEpreuves $idInscriptionEpreuve): self
    {
        if (!$this->inscriptionEpreuve->contains($idInscriptionEpreuve)) {
            $this->inscriptionEpreuve[] = $idInscriptionEpreuve;
            $idInscriptionEpreuve->setTypeNote($this);
        }

        return $this;
    }

    public function removeIdInscriptionEpreuve(InscriptionsEpreuves $idInscriptionEpreuve): self
    {
        if ($this->inscriptionEpreuve->removeElement($idInscriptionEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionEpreuve->getTypeNote() === $this) {
                $idInscriptionEpreuve->setTypeNote(null);
            }
        }

        return $this;
    }

}
