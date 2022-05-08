<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Periode
 *
 * @ORM\Table(name="periodes",
 *     indexes={
 *         @ORM\Index(name="fk_periodes_parcours_idx", columns={"id_parcours"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PeriodeRepository")
 */
class Periode
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
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"=null})
     */
    private $codeApogee;

    /**
     * @var Parcour
     *
     * @ORM\ManyToOne(targetEntity="Parcour", inversedBy="periodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id", nullable=false)
     * })
     */
    private $parcour;

    /**
     * @ORM\OneToMany(targetEntity=PeriodeUe::class, mappedBy="periode")
     */
    private $periodesUes;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="periode")
     */
    private $inscriptionsPeriodes;


    // *******************************************************************
    public function __construct()
    {
        $this->codeApogee = null;
        $this->periodesUes = new ArrayCollection();
        $this->inscriptionsPeriodes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

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

    public function getParcour(): ?Parcour
    {
        return $this->parcour;
    }

    public function setParcour(?Parcour $parcour): self
    {
        $this->parcour = $parcour;

        return $this;
    }

    /**
     * @return Collection<int, PeriodeUe>
     */
    public function getPeriodesUes(): Collection
    {
        return $this->periodesUes;
    }

    public function addPeriodeUe(PeriodeUe $periodeUe): self
    {
        if (!$this->periodesUes->contains($periodeUe)) {
            $this->periodesUes[] = $periodeUe;
            $periodeUe->setPeriode($this);
        }

        return $this;
    }

    public function removePeriodeUe(PeriodeUe $periodeUe): self
    {
        if ($this->periodesUes->removeElement($periodeUe)) {
            // set the owning side to null (unless already changed)
            if ($periodeUe->getPeriode() === $this) {
                $periodeUe->setPeriode(null);
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
            $inscriptionPeriode->setPeriode($this);
        }

        return $this;
    }

    public function removeInscriptionPeriode(InscriptionsPeriodes $inscriptionPeriode): self
    {
        if ($this->inscriptionsPeriodes->removeElement($inscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionPeriode->getPeriode() === $this) {
                $inscriptionPeriode->setPeriode(null);
            }
        }

        return $this;
    }

}
