<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsEpreuves
 *
 * @ORM\Table(name="inscriptions_epreuves", indexes={@ORM\Index(name="fk_inscriptions_epreuves_parcours_ues_idx", columns={"id_parcours_ue"}), @ORM\Index(name="fk_inscriptions_epreuves_epreuves_idx", columns={"id_epreuve"}), @ORM\Index(name="fk_inscriptions_epreuves_types_note_idx", columns={"id_type_note"}), @ORM\Index(name="fk_inscriptions_epreuves_etudiants_idx", columns={"id_etudiant"})})
 * @ORM\Entity
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
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $note = NULL;

    /**
     * @var Epreuves
     *
     * @ORM\ManyToOne(targetEntity="Epreuves", inversedBy = "idInscriptionEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_epreuve", referencedColumnName="id")
     * })
     */
    private $idEpreuve;

    /**
     * @var PeriodesUes
     *
     * @ORM\ManyToOne(targetEntity="PeriodesUes", inversedBy = "idInscriptionEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours_ue", referencedColumnName="id")
     * })
     */
    private $idPeriodeUe;

    /**
     * @var Etudiants
     *
     * @ORM\ManyToOne(targetEntity="Etudiants", inversedBy = "idInscriptionEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $idEtudiant;

    /**
     * @var ParcoursUes
     *
     * @ORM\ManyToOne(targetEntity="ParcoursUes", inversedBy = "idInscriptionEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours_ue", referencedColumnName="id")
     * })
     */
    private $idParcoursUe;

    /**
     * @var TypesNote
     *
     * @ORM\ManyToOne(targetEntity="TypesNote", inversedBy = "idInscriptionEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id")
     * })
     */
    private $idTypeNote;
}
