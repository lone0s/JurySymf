<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Periodes
 *
 * @ORM\Table(name="periodes",
 *     indexes={@ORM\Index(name="fk_periodes_parcours_idx", columns={"id_parcours"})})
 * @ORM\Entity(repositoryClass="App\Repository\PeriodesRepository")
 */
class Periodes
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
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $codeApogee = 'NULL';

    /**
     * @var Parcours
     *
     * @ORM\ManyToOne(targetEntity="Parcours", inversedBy="periode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id")
     * })
     */
    private $parcours;


    /**
     * @ORM\OneToMany(targetEntity=PeriodesUes::class, mappedBy="periode")
     */
    private $periodeUe;


    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="periode")
     */
    private $inscriptionPeriode;

    public function __construct()
    {
        $this->periodeUe = new ArrayCollection();
        $this->idParcoursUe = new ArrayCollection();
        $this->inscriptionPeriode = new ArrayCollection();
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

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): self
    {
        $this->parcours = $parcours;

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
            $idPeriodeUe->setPeriode($this);
        }

        return $this;
    }

    public function removeIdPeriodeUe(PeriodesUes $idPeriodeUe): self
    {
        if ($this->periodeUe->removeElement($idPeriodeUe)) {
            // set the owning side to null (unless already changed)
            if ($idPeriodeUe->getPeriode() === $this) {
                $idPeriodeUe->setPeriode(null);
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
            $idParcoursUe->setIdPeriode($this);
        }

        return $this;
    }

    public function removeIdParcoursUe(ParcoursUes $idParcoursUe): self
    {
        if ($this->idParcoursUe->removeElement($idParcoursUe)) {
            // set the owning side to null (unless already changed)
            if ($idParcoursUe->getIdPeriode() === $this) {
                $idParcoursUe->setIdPeriode(null);
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
            $idInscriptionPeriode->setPeriode($this);
        }

        return $this;
    }

    public function removeIdInscriptionPeriode(InscriptionsPeriodes $idInscriptionPeriode): self
    {
        if ($this->inscriptionPeriode->removeElement($idInscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionPeriode->getPeriode() === $this) {
                $idInscriptionPeriode->setPeriode(null);
            }
        }

        return $this;
    }

}
