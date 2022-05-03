<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ues
 *
 * @ORM\Table(name="ues")
 * @ORM\Entity(repositoryClass="App\Repository\UesRepository")
 */
class Ues
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
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_court", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $nomCourt = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="ects", type="float", precision=10, scale=0, nullable=false, options={"comment"="crédits européens"})
     */
    private $ects;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $codeApogee = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @ORM\OneToMany(targetEntity=PeriodesUes::class, mappedBy="ue")
     */
    private $periodeUe;


    /**
     * @ORM\OneToMany(targetEntity=Epreuves::class, mappedBy="ue")
     */
    private $epreuve;

    public function __construct()
    {
        $this->periodeUe = new ArrayCollection();
        $this->periodeUe = new ArrayCollection();
        $this->epreuve = new ArrayCollection();
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

    public function setNomCourt(?string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getEcts(): ?float
    {
        return $this->ects;
    }

    public function setEcts(float $ects): self
    {
        $this->ects = $ects;

        return $this;
    }

    public function getCodeApogee(): ?string
    {
        return $this->codeApogee;
    }

    public function setCodeApogee(?string $codeApogee): self
    {
        $this->codeApogee = $codeApogee;

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
     * @return Collection<int, PeriodesUes>
     */
    public function getPeriodeUe(): Collection
    {
        return $this->periodeUe;
    }

    public function addIdPeriodeUe(PeriodesUes $idPeriodeUe): self
    {
        if (!$this->periodeUe->contains($idPeriodeUe)) {
            $this->periodeUe[] = $idPeriodeUe;
            $idPeriodeUe->setUe($this);
        }

        return $this;
    }

    public function removeIdPeriodeUe(PeriodesUes $idPeriodeUe): self
    {
        if ($this->periodeUe->removeElement($idPeriodeUe)) {
            // set the owning side to null (unless already changed)
            if ($idPeriodeUe->getUe() === $this) {
                $idPeriodeUe->setUe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ParcoursUes>
     */
    public function getIdParcoursUe(): Collection
    {
        return $this->idParcoursUe;
    }

    public function addIdParcoursUe(ParcoursUes $idParcoursUe): self
    {
        if (!$this->idParcoursUe->contains($idParcoursUe)) {
            $this->idParcoursUe[] = $idParcoursUe;
            $idParcoursUe->setIdUe($this);
        }

        return $this;
    }

    public function removeIdParcoursUe(ParcoursUes $idParcoursUe): self
    {
        if ($this->idParcoursUe->removeElement($idParcoursUe)) {
            // set the owning side to null (unless already changed)
            if ($idParcoursUe->getIdUe() === $this) {
                $idParcoursUe->setIdUe(null);
            }
        }

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
            $idEpreuve->setUe($this);
        }

        return $this;
    }

    public function removeIdEpreuve(Epreuves $idEpreuve): self
    {
        if ($this->epreuve->removeElement($idEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($idEpreuve->getUe() === $this) {
                $idEpreuve->setUe(null);
            }
        }

        return $this;
    }


}
