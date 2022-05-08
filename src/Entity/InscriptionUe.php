<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsUes
 *
 * @ORM\Table(name="inscriptions_ues")
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionUeRepository")
 */
class InscriptionUe
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
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true, options={"default"=null})
     */
    private $note;

    /**
     * @var float
     *
     * @ORM\Column(name="points_jury", type="float", precision=10, scale=0, nullable=true, options={"default"=null})
     */
    private $pointsJury;

    /**
     * @var bool
     *
     * @ORM\Column(name="saisie", type="boolean", nullable=false, options={"comment"="booléen", "default"=false})
     */
    private $saisie;

    /**
     * @var Etudiant
     *
     * @ORM\ManyToOne(targetEntity="Etudiant", inversedBy = "inscriptionsUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id", nullable=false)
     * })
     */
    private $etudiant;

    /**
     * @var TypeNote
     *
     * @ORM\ManyToOne(targetEntity="TypeNote", inversedBy = "inscriptionsUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id", nullable=true)
     * })
     */
    private $typeNote;

    /**
     * @var PeriodeUe
     *
     * @ORM\ManyToOne(targetEntity="PeriodeUe", inversedBy = "inscriptionsUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode_ue", referencedColumnName="id", nullable=false)
     * })
     */
    private $periodeUe;

    /**
     * @var TypeResultat
     *
     * @ORM\ManyToOne(targetEntity="TypeResultat", inversedBy = "inscriptionsUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_resultat", referencedColumnName="id", nullable=true)
     * })
     */
    private $typeResultat;


    // *******************************************************************
    public function __construct()
    {
        $this->note = null;
        $this->pointsJury = null;
        $this->saisie = false;
        $this->typeNote =null;
        $this->typeResultat = null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getPointsJury(): ?float
    {
        return $this->pointsJury;
    }

    public function setPointsJury(?float $pointsJury): self
    {
        $this->pointsJury = $pointsJury;

        return $this;
    }

    public function getSaisie(): ?bool
    {
        return $this->saisie;
    }

    public function setSaisie(bool $saisie): self
    {
        $this->saisie = $saisie;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getTypeNote(): ?TypeNote
    {
        return $this->typeNote;
    }

    public function setTypeNote(?TypeNote $typeNote): self
    {
        $this->typeNote = $typeNote;

        return $this;
    }

    public function getPeriodeUe(): ?PeriodeUe
    {
        return $this->periodeUe;
    }

    public function setPeriodeUe(?PeriodeUe $periodeUe): self
    {
        $this->periodeUe = $periodeUe;

        return $this;
    }

    public function getTypeResultat(): ?TypeResultat
    {
        return $this->typeResultat;
    }

    public function setTypeResultat(?TypeResultat $typeResultat): self
    {
        $this->typeResultat = $typeResultat;

        return $this;
    }



}
