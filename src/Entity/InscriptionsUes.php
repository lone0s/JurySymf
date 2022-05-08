<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsUes
 *
 * @ORM\Table(name="inscriptions_ues")
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionsUesRepository")
 */
class InscriptionsUes
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
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true)
     */
    private $note = NULL;

    /**
     * @var float
     *
     * @ORM\Column(name="points_jury", type="float", precision=10, scale=0, nullable=true)
     */
    private $pointsJury = NULL;

    /**
     * @var bool
     *
     * @ORM\Column(name="saisie", type="boolean", nullable=false, options={"comment"="booléen"})
     */
    private $saisie = '0';

    /**
     * @var Etudiants
     *
     * @ORM\ManyToOne(targetEntity="Etudiants", inversedBy = "inscriptionUe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $etudiant;

    /**
     * @var TypeNote
     *
     * @ORM\ManyToOne(targetEntity="TypeNote", inversedBy = "inscriptionsUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id")
     * })
     */
    private $typeNote;

    /**
     * @var PeriodeUe
     *
     * @ORM\ManyToOne(targetEntity="PeriodeUe", inversedBy = "inscriptionsUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode_ue", referencedColumnName="id")
     * })
     */
    private $periodeUe;

    /**
     * @var TypeResultat
     *
     * @ORM\ManyToOne(targetEntity="TypeResultat", inversedBy = "inscriptionsUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_resultat", referencedColumnName="id", nullable = true)
     * })
     */
    private $typeResultat;



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

    public function getEtudiant(): ?Etudiants
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiants $etudiant): self
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
