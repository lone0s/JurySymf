<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionEpreuve
 *
 * @ORM\Table
 * (
 *     name="inscriptions_epreuves",
 *     indexes={
 *         @ORM\Index(name="fk_inscriptions_epreuves_periodes_ues_idx", columns={"id_periode_ue"}),
 *         @ORM\Index(name="fk_inscriptions_epreuves_epreuves_idx", columns={"id_epreuve"}),
 *         @ORM\Index(name="fk_inscriptions_epreuves_types_note_idx", columns={"id_type_note"}),
 *         @ORM\Index(name="fk_inscriptions_epreuves_etudiants_idx", columns={"id_etudiant"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionEpreuveRepository")
 */
class InscriptionEpreuve
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
     * @var Epreuve
     *
     * @ORM\ManyToOne(targetEntity="Epreuve", inversedBy = "inscriptionsEpreuves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_epreuve", referencedColumnName="id", nullable=false)
     * })
     */
    private $epreuve;

    /**
     * @var PeriodeUe
     *
     * @ORM\ManyToOne(targetEntity="PeriodeUe", inversedBy = "inscriptionsEpreuves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode_ue", referencedColumnName="id", nullable=false)
     * })
     */
    private $periodeUe;

    /**
     * @var Etudiant
     *
     * @ORM\ManyToOne(targetEntity="Etudiant", inversedBy = "inscriptionsEpreuves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id",nullable=false)
     * })
     */
    private $etudiant;


    /**
     * @var TypeNote
     *
     * @ORM\ManyToOne(targetEntity="TypeNote", inversedBy = "inscriptionsEpreuves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id", nullable=true)
     * })
     */
    private $typeNote;


    // *******************************************************************
    public function __construct()
    {
        $this->note = null;
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

    public function getEpreuve(): ?Epreuve
    {
        return $this->epreuve;
    }

    public function setEpreuve(?Epreuve $epreuve): self
    {
        $this->epreuve = $epreuve;

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
}
