<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypesResultat
 *
 * @ORM\Table(name="types_resultat", uniqueConstraints={@ORM\UniqueConstraint(name="types_resultatcol_UNIQUE", columns={"type"})})
 * @ORM\Entity(repositoryClass="App\Repository\TypesResultatRepository")
 */
class TypesResultat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="n'est pas auto-incrémenté (cf. commentaire de la table)"})
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
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="typeResultat")
     */
    private $inscriptionParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="typeResultat")
     */
    private $inscriptionPeriode;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="typeResultat")
     */
    private $inscriptionUe;

    public function __construct()
    {
        $this->inscriptionParcours = new ArrayCollection();
        $this->inscriptionPeriode = new ArrayCollection();
        $this->inscriptionUe = new ArrayCollection();
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
            $idInscriptionParcour->setTypeResultat($this);
        }

        return $this;
    }

    public function removeIdInscriptionParcour(InscriptionsParcours $idInscriptionParcour): self
    {
        if ($this->inscriptionParcours->removeElement($idInscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionParcour->getTypeResultat() === $this) {
                $idInscriptionParcour->setTypeResultat(null);
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
            $idInscriptionPeriode->setTypeResultat($this);
        }

        return $this;
    }

    public function removeIdInscriptionPeriode(InscriptionsPeriodes $idInscriptionPeriode): self
    {
        if ($this->inscriptionPeriode->removeElement($idInscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionPeriode->getTypeResultat() === $this) {
                $idInscriptionPeriode->setTypeResultat(null);
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
            $idInscriptionUe->setTypeResultat($this);
        }

        return $this;
    }

    public function removeIdInscriptionUe(InscriptionsUes $idInscriptionUe): self
    {
        if ($this->inscriptionUe->removeElement($idInscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionUe->getTypeResultat() === $this) {
                $idInscriptionUe->setTypeResultat(null);
            }
        }

        return $this;
    }

}
