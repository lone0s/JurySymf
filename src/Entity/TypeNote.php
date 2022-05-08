<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypesNote
 *
 * @ORM\Table(
 *     name="types_note",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="type_UNIQUE", columns={"type"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TypeNoteRepository")
 */
class TypeNote
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
     * @ORM\Column(name="commentaire", type="string", length=100, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="typeNote")
     */
    private $inscriptionsParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="typeNote")
     */
    private $inscriptionsPeriodes;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="typeNote")
     */
    private $inscriptionsUes;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsEpreuves::class, mappedBy="typeNote")
     */
    private $inscriptionsEpreuves;


    // *******************************************************************
    public function __construct()
    {
        $this->commentaire = null;
        $this->inscriptionsParcours = new ArrayCollection();
        $this->inscriptionsPeriodes = new ArrayCollection();
        $this->inscriptionsUes = new ArrayCollection();
        $this->inscriptionsEpreuves = new ArrayCollection();
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
    public function getInscriptionsParcours(): Collection
    {
        return $this->inscriptionsParcours;
    }

    public function addInscriptionParcour(InscriptionsParcours $inscriptionParcour): self
    {
        if (!$this->inscriptionsParcours->contains($inscriptionParcour)) {
            $this->inscriptionsParcours[] = $inscriptionParcour;
            $inscriptionParcour->setTypeNote($this);
        }

        return $this;
    }

    public function removeInscriptionParcour(InscriptionsParcours $inscriptionParcour): self
    {
        if ($this->inscriptionsParcours->removeElement($inscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionParcour->getTypeNote() === $this) {
                $inscriptionParcour->setTypeNote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsPeriodes>
     */
    public function getInscriptionsPeriodes(): Collection
    {
        return $this->inscriptionsPeriodes;
    }

    public function addInscriptionPeriode(InscriptionsPeriodes $iInscriptionPeriode): self
    {
        if (!$this->inscriptionsPeriodes->contains($iInscriptionPeriode)) {
            $this->inscriptionsPeriodes[] = $iInscriptionPeriode;
            $iInscriptionPeriode->setTypeNote($this);
        }

        return $this;
    }

    public function removeInscriptionPeriode(InscriptionsPeriodes $inscriptionPeriode): self
    {
        if ($this->inscriptionsPeriodes->removeElement($inscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionPeriode->getTypeNote() === $this) {
                $inscriptionPeriode->setTypeNote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsUes>
     */
    public function getInscriptionsUes(): Collection
    {
        return $this->inscriptionsUes;
    }

    public function addInscriptionUe(InscriptionsUes $inscriptionUe): self
    {
        if (!$this->inscriptionsUes->contains($inscriptionUe)) {
            $this->inscriptionsUes[] = $inscriptionUe;
            $inscriptionUe->setTypeNote($this);
        }

        return $this;
    }

    public function removeInscriptionUe(InscriptionsUes $inscriptionUe): self
    {
        if ($this->inscriptionsUes->removeElement($inscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionUe->getTypeNote() === $this) {
                $inscriptionUe->setTypeNote(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsEpreuves>
     */
    public function getInscriptionsEpreuves(): Collection
    {
        return $this->inscriptionsEpreuves;
    }

    public function addInscriptionEpreuve(InscriptionsEpreuves $inscriptionEpreuve): self
    {
        if (!$this->inscriptionsEpreuves->contains($inscriptionEpreuve)) {
            $this->inscriptionsEpreuves[] = $inscriptionEpreuve;
            $inscriptionEpreuve->setTypeNote($this);
        }

        return $this;
    }

    public function removeInscriptionEpreuve(InscriptionsEpreuves $inscriptionEpreuve): self
    {
        if ($this->inscriptionsEpreuves->removeElement($inscriptionEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionEpreuve->getTypeNote() === $this) {
                $inscriptionEpreuve->setTypeNote(null);
            }
        }

        return $this;
    }

}
