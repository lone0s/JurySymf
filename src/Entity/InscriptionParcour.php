<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionParcour
 *
 * @ORM\Table(
 *     name="inscriptions_parcours",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="index4", columns={"id_etudiant", "id_parcours"})
 *     },
 *     indexes={
 *         @ORM\Index(name="fk_inscriptions_parcours_types_resultat_idx", columns={"id_type_resultat"}),
 *         @ORM\Index(name="fk_inscriptions_parcours_etudiants_idx", columns={"id_etudiant"}),
 *         @ORM\Index(name="fk_inscriptions_parcours_parcours_idx", columns={"id_parcours"}),
 *         @ORM\Index(name="fk_inscriptions_parcours_types_note_idx", columns={"id_type_note"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionParcourRepository")
 */
class InscriptionParcour
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
     * @ORM\ManyToOne(targetEntity="Etudiant", inversedBy = "inscriptionsParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id", nullable=false)
     * })
     */
    private $etudiant;

    /**
     * @var TypeNote
     *
     * @ORM\ManyToOne(targetEntity="TypeNote", inversedBy = "inscriptionsParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id", nullable=true)
     * })
     */
    private $typeNote;

    /**
     * @var Parcour
     *
     * @ORM\ManyToOne(targetEntity="Parcour", inversedBy = "inscriptionsParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id", nullable=false)
     * })
     */
    private $parcour;

    /**
     * @var TypeResultat
     *
     * @ORM\ManyToOne(targetEntity="TypeResultat", inversedBy = "inscriptionsParcours")
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
        $this->typeNote = null;
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

    public function getParcour(): ?Parcour
    {
        return $this->parcour;
    }

    public function setParcour(?Parcour $parcour): self
    {
        $this->parcour = $parcour;

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
