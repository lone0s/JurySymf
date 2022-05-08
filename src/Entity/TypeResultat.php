<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeResultat
 *
 * @ORM\Table(
 *     name="types_resultat",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="types_resultatcol_UNIQUE", columns={"type"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TypeResultatRepository")
 */
class TypeResultat
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
     * @ORM\Column(name="commentaire", type="string", length=100, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="typeResultat")
     */
    private $inscriptionsParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="typeResultat")
     */
    private $inscriptionsPeriodes;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="typeResultat")
     */
    private $inscriptionsUes;


    // *******************************************************************
    public function __construct()
    {
        $this->commentaire = null;
        $this->inscriptionsParcours = new ArrayCollection();
        $this->inscriptionsPeriodes = new ArrayCollection();
        $this->inscriptionsUes = new ArrayCollection();
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
            $inscriptionParcour->setTypeResultat($this);
        }

        return $this;
    }

    public function removeInscriptionParcour(InscriptionsParcours $inscriptionParcour): self
    {
        if ($this->inscriptionsParcours->removeElement($inscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionParcour->getTypeResultat() === $this) {
                $inscriptionParcour->setTypeResultat(null);
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

    public function addInscriptionPeriode(InscriptionsPeriodes $inscriptionPeriode): self
    {
        if (!$this->inscriptionsPeriodes->contains($inscriptionPeriode)) {
            $this->inscriptionsPeriodes[] = $inscriptionPeriode;
            $inscriptionPeriode->setTypeResultat($this);
        }

        return $this;
    }

    public function removeInscriptionPeriode(InscriptionsPeriodes $inscriptionPeriode): self
    {
        if ($this->inscriptionsPeriodes->removeElement($inscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionPeriode->getTypeResultat() === $this) {
                $inscriptionPeriode->setTypeResultat(null);
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
            $inscriptionUe->setTypeResultat($this);
        }

        return $this;
    }

    public function removeInscriptionUe(InscriptionsUes $inscriptionUe): self
    {
        if ($this->inscriptionsUes->removeElement($inscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionUe->getTypeResultat() === $this) {
                $inscriptionUe->setTypeResultat(null);
            }
        }

        return $this;
    }

}
