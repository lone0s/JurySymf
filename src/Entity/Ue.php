<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ue
 *
 * @ORM\Table(name="ues")
 * @ORM\Entity(repositoryClass="App\Repository\UeRepository")
 */
class Ue
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
     * @ORM\Column(name="nom_court", type="string", length=20, nullable=true, options={"default"=null})
     */
    private $nomCourt;

    /**
     * @var float
     *
     * @ORM\Column(name="ects", type="float", precision=10, scale=0, nullable=false, options={"comment"="crédits européens"})
     */
    private $ects;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"=null})
     */
    private $codeApogee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=PeriodesUes::class, mappedBy="ue")
     */
    private $periodesUes;

    /**
     * @ORM\OneToMany(targetEntity=Epreuves::class, mappedBy="ue")
     */
    private $epreuves;


    // *******************************************************************
    public function __construct()
    {
        $this->nomCourt = null;
        $this->codeApogee = null;
        $this->commentaire = null;
        $this->periodesUes = new ArrayCollection();
        $this->epreuves = new ArrayCollection();
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
    public function getPeriodesUes(): Collection
    {
        return $this->periodesUes;
    }

    public function addPeriodeUe(PeriodesUes $periodeUe): self
    {
        if (!$this->periodesUes->contains($periodeUe)) {
            $this->periodesUes[] = $periodeUe;
            $periodeUe->setUe($this);
        }

        return $this;
    }

    public function removePeriodeUe(PeriodesUes $periodeUe): self
    {
        if ($this->periodesUes->removeElement($periodeUe)) {
            // set the owning side to null (unless already changed)
            if ($periodeUe->getUe() === $this) {
                $periodeUe->setUe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Epreuves>
     */
    public function getEpreuves(): Collection
    {
        return $this->epreuves;
    }

    public function addEpreuve(Epreuves $epreuve): self
    {
        if (!$this->epreuves->contains($epreuve)) {
            $this->epreuves[] = $epreuve;
            $epreuve->setUe($this);
        }

        return $this;
    }

    public function removeEpreuve(Epreuves $epreuve): self
    {
        if ($this->epreuves->removeElement($epreuve)) {
            // set the owning side to null (unless already changed)
            if ($epreuve->getUe() === $this) {
                $epreuve->setUe(null);
            }
        }

        return $this;
    }

}
