<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsPeriodes
 *
 * @ORM\Table(name="inscriptions_periodes", uniqueConstraints={@ORM\UniqueConstraint(name="index6", columns={"id_etudiant", "id_periode"})}, indexes={@ORM\Index(name="fk_inscriptions_periodes_periodes_idx", columns={"id_periode"}), @ORM\Index(name="fk_inscriptions_periodes_etudiants_idx", columns={"id_etudiant"}), @ORM\Index(name="fk_inscriptions_periodes_types_note_idx", columns={"id_type_note"}), @ORM\Index(name="fk_inscriptions_periodes_types_resultat_idx", columns={"id_type_resultat"})})
 * @ORM\Entity
 */
class InscriptionsPeriodes
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
     * @var float|null
     *
     * @ORM\Column(name="points_jury", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $pointsJury = NULL;

    /**
     * @var bool
     *
     * @ORM\Column(name="saisie", type="boolean", nullable=false, options={"comment"="booléen"})
     */
    private $saisie = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="inscription_partielle", type="boolean", nullable=false, options={"comment"="indique si l'inscription concerne l'ensemble des UEs de la période et donc si une note doit apparaître"})
     */
    private $inscriptionPartielle = '0';

    /**
     * @var Etudiants
     *
     * @ORM\ManyToOne(targetEntity="Etudiants", inversedBy = "idInscriptionPeriode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $idEtudiant;

    /**
     * @var TypesNote
     *
     * @ORM\ManyToOne(targetEntity="TypesNote", inversedBy = "idInscriptionPeriode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id")
     * })
     */
    private $idTypeNote;

    /**
     * @var Periodes
     *
     * @ORM\ManyToOne(targetEntity="Periodes", inversedBy = "idInscriptionPeriode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode", referencedColumnName="id")
     * })
     */
    private $idPeriode;

    /**
     * @var TypesResultat
     *
     * @ORM\ManyToOne(targetEntity="TypesResultat", inversedBy = "idInscriptionPeriode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_resultat", referencedColumnName="id")
     * })
     */
    private $idTypeResultat;
}
