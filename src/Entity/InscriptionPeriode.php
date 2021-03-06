<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsPeriodes
 *
 * @ORM\Table(
 *     name="inscriptions_periodes",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="index6", columns={"id_etudiant", "id_periode"})
 *     },
 *     indexes={
 *         @ORM\Index(name="fk_inscriptions_periodes_periodes_idx", columns={"id_periode"}),
 *         @ORM\Index(name="fk_inscriptions_periodes_etudiants_idx", columns={"id_etudiant"}),
 *         @ORM\Index(name="fk_inscriptions_periodes_types_note_idx", columns={"id_type_note"}),
 *         @ORM\Index(name="fk_inscriptions_periodes_types_resultat_idx", columns={"id_type_resultat"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionPeriodeRepository")
 */
class InscriptionPeriode
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
     * @var float|null
     *
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true, options={"default"=null})
     */
    private $note;

    /**
     * @var float|null
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
     * @var bool
     *
     * @ORM\Column(
     *     name="inscription_partielle",
     *     type="boolean",
     *     nullable=false,
     *     options={
     *         "comment"="indique si l'inscription concerne l'ensemble des UEs de la période et donc si une note doit apparaître",
     *         "default"=false
     *     }
     * )
     */
    private $inscriptionPartielle;

    /**
     * @var Etudiant
     *
     * @ORM\ManyToOne(targetEntity="Etudiant", inversedBy = "inscriptionsPeriodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id", nullable=false)
     * })
     */
    private $etudiant;

    /**
     * @var TypeNote
     *
     * @ORM\ManyToOne(targetEntity="TypeNote", inversedBy = "inscriptionsPeriodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id", nullable=true)
     * })
     */
    private $typeNote;

    /**
     * @var Periode
     *
     * @ORM\ManyToOne(targetEntity="Periode", inversedBy = "inscriptionsPeriodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode", referencedColumnName="id", nullable=false)
     * })
     */
    private $periode;

    /**
     * @var TypeResultat
     *
     * @ORM\ManyToOne(targetEntity="TypeResultat", inversedBy = "inscriptionsPeriodes")
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
        $this->inscriptionPartielle = false;
        $this->typeResultat = null;
        $this->typeNote = null;
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

    public function getInscriptionPartielle(): ?bool
    {
        return $this->inscriptionPartielle;
    }

    public function setInscriptionPartielle(bool $inscriptionPartielle): self
    {
        $this->inscriptionPartielle = $inscriptionPartielle;

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

    public function getPeriode(): ?Periode
    {
        return $this->periode;
    }

    public function setPeriode(?Periode $periode): self
    {
        $this->periode = $periode;

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
