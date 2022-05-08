<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PeriodesUes
 *
 * @ORM\Table(name="periodes_ues", uniqueConstraints=
 *     {@ORM\UniqueConstraint(name="index4", columns={"id_ue", "id_periode"})},
 *     indexes={@ORM\Index(name="fk_pu_ues_idx", columns={"id_ue"}),
 *     @ORM\Index(name="fk_pu_periodes_idx", columns={"id_periode"})})
 * @ORM\Entity(repositoryClass="App\Repository\PeriodesUesRepository")
 */
class PeriodesUes
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
     * @var float
     *
     * @ORM\Column(name="note_eliminatoire", type="float", precision=10, scale=0, nullable=true)
     */
    private $noteEliminatoire;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer", nullable=false, options={"comment"="ordre d'affichage"})
     */
    private $rang;

    /**
     * @var Periode
     *
     * @ORM\ManyToOne(targetEntity="Periode", inversedBy = "periodesUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode", referencedColumnName="id")
     * })
     */
    private $periode;


    /**
     * @var Ue
     *
     * @ORM\ManyToOne(targetEntity="Ue", inversedBy = "periodesUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ue", referencedColumnName="id")
     * })
     */
    private $ue;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsEpreuves::class, mappedBy="periodeUe")
     */
    private $inscriptionEpreuve;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="periodeUe")
     */
    private $inscriptionUe;

    public function __construct()
    {
        $this->inscriptionEpreuve = new ArrayCollection();
        $this->inscriptionUe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoteEliminatoire(): ?float
    {
        return $this->noteEliminatoire;
    }

    public function setNoteEliminatoire(?float $noteEliminatoire): self
    {
        $this->noteEliminatoire = $noteEliminatoire;

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getUe(): ?Ue
    {
        return $this->ue;
    }

    public function setUe(?Ue $ue): self
    {
        $this->ue = $ue;

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
            $idInscriptionEpreuve->setPeriodeUe($this);
        }

        return $this;
    }

    public function removeIdInscriptionEpreuve(InscriptionsEpreuves $idInscriptionEpreuve): self
    {
        if ($this->inscriptionEpreuve->removeElement($idInscriptionEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionEpreuve->getPeriodeUe() === $this) {
                $idInscriptionEpreuve->setPeriodeUe(null);
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
            $idInscriptionUe->setPeriodeUe($this);
        }

        return $this;
    }

    public function removeIdInscriptionUe(InscriptionsUes $idInscriptionUe): self
    {
        if ($this->inscriptionUe->removeElement($idInscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionUe->getPeriodeUe() === $this) {
                $idInscriptionUe->setPeriodeUe(null);
            }
        }

        return $this;
    }



}
