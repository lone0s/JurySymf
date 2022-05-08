<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsParcours
 *
 * @ORM\Table(name="inscriptions_parcours", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="index4", columns={"id_etudiant", "id_parcours"})},
 *     indexes={@ORM\Index(name="fk_inscriptions_parcours_types_resultat_idx", columns={"id_type_resultat"}),
 *     @ORM\Index(name="fk_inscriptions_parcours_etudiants_idx", columns={"id_etudiant"}),
 *     @ORM\Index(name="fk_inscriptions_parcours_parcours_idx", columns={"id_parcours"}),
 *     @ORM\Index(name="fk_inscriptions_parcours_types_note_idx", columns={"id_type_note"})})
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionsParcoursRepository")
 */
class InscriptionsParcours
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
     * @ORM\ManyToOne(targetEntity="Etudiants", inversedBy = "inscriptionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $etudiant;

    /**
     * @var TypesNote
     *
     * @ORM\ManyToOne(targetEntity="TypesNote", inversedBy = "inscriptionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id")
     * })
     */
    private $typeNote;

    /**
     * @var Parcour
     *
     * @ORM\ManyToOne(targetEntity="Parcour", inversedBy = "inscriptionsParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id")
     * })
     */
    private $parcour;

    /**
     * @var TypeResultat
     *
     * @ORM\ManyToOne(targetEntity="TypeResultat", inversedBy = "inscriptionsParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_resultat", referencedColumnName="id")
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

    public function getTypeNote(): ?TypesNote
    {
        return $this->typeNote;
    }

    public function setTypeNote(?TypesNote $typeNote): self
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
