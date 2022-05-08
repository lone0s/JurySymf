<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsEpreuves
 *
 * @ORM\Table
 * (
 *     name="inscriptions_epreuves",
 *     indexes={
 *      @ORM\Index(name="fk_inscriptions_epreuves_periodes_ues_idx", columns={"id_periode_ue"}),
 *      @ORM\Index(name="fk_inscriptions_epreuves_epreuves_idx", columns={"id_epreuve"}),
 *      @ORM\Index(name="fk_inscriptions_epreuves_types_note_idx", columns={"id_type_note"}),
 *      @ORM\Index(name="fk_inscriptions_epreuves_etudiants_idx", columns={"id_etudiant"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionsEpreuvesRepository")
 */
class InscriptionsEpreuves
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
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true)
     */
    private $note = NULL;

    /**
     * @var Epreuves
     *
     * @ORM\ManyToOne(targetEntity="Epreuves", inversedBy = "inscriptionEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_epreuve", referencedColumnName="id")
     * })
     */
    private $epreuve;

    /**
     * @var PeriodeUe
     *
     * @ORM\ManyToOne(targetEntity="PeriodeUe", inversedBy = "inscriptionsEpreuves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode_ue", referencedColumnName="id",nullable = true)
     * })
     */
    private $periodeUe;

    /**
     * @var Etudiants
     *
     * @ORM\ManyToOne(targetEntity="Etudiants", inversedBy = "inscriptionEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id",nullable = true)
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

    public function getEpreuve(): ?Epreuves
    {
        return $this->epreuve;
    }

    public function setEpreuve(?Epreuves $epreuve): self
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
}
