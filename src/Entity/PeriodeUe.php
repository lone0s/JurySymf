<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PeriodesUes
 *
 * @ORM\Table(
 *     name="periodes_ues",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="index4", columns={"id_ue", "id_periode"})
 *     },
 *     indexes={
 *         @ORM\Index(name="fk_pu_ues_idx", columns={"id_ue"}),
 *         @ORM\Index(name="fk_pu_periodes_idx", columns={"id_periode"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PeriodeUeRepository")
 */
class PeriodeUe
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
     * @ORM\Column(name="note_eliminatoire", type="float", precision=10, scale=0, nullable=true, options={"default"=null})
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
     *   @ORM\JoinColumn(name="id_periode", referencedColumnName="id", nullable=false)
     * })
     */
    private $periode;

    /**
     * @var Ue
     *
     * @ORM\ManyToOne(targetEntity="Ue", inversedBy = "periodesUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ue", referencedColumnName="id", nullable=false)
     * })
     */
    private $ue;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsEpreuves::class, mappedBy="periodeUe")
     */
    private $inscriptionsEpreuves;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="periodeUe")
     */
    private $inscriptionsUes;


    // *******************************************************************
    public function __construct()
    {
        $this->noteEliminatoire = null;
        $this->inscriptionsEpreuves = new ArrayCollection();
        $this->inscriptionsUes = new ArrayCollection();
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
    public function getInscriptionsEpreuves(): Collection
    {
        return $this->inscriptionsEpreuves;
    }

    public function addInscriptionEpreuve(InscriptionsEpreuves $inscriptionEpreuve): self
    {
        if (!$this->inscriptionsEpreuves->contains($inscriptionEpreuve)) {
            $this->inscriptionsEpreuves[] = $inscriptionEpreuve;
            $inscriptionEpreuve->setPeriodeUe($this);
        }

        return $this;
    }

    public function removeInscriptionEpreuve(InscriptionsEpreuves $inscriptionEpreuve): self
    {
        if ($this->inscriptionsEpreuves->removeElement($inscriptionEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionEpreuve->getPeriodeUe() === $this) {
                $inscriptionEpreuve->setPeriodeUe(null);
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
            $inscriptionUe->setPeriodeUe($this);
        }

        return $this;
    }

    public function removeInscriptionUe(InscriptionsUes $inscriptionUe): self
    {
        if ($this->inscriptionsUes->removeElement($inscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionUe->getPeriodeUe() === $this) {
                $inscriptionUe->setPeriodeUe(null);
            }
        }

        return $this;
    }

}
