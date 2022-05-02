<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsUes
 *
 * @ORM\Table(name="inscriptions_ues", uniqueConstraints={@ORM\UniqueConstraint(name="index6", columns={"id_etudiant", "id_parcours_ue"})}, indexes={@ORM\Index(name="fk_inscriptions_ues_types_resultat_idx", columns={"id_type_resultat"}), @ORM\Index(name="fk_inscriptions_ues_etudiants_idx", columns={"id_etudiant"}), @ORM\Index(name="fk_inscriptions_ues_parcours_ues_idx", columns={"id_parcours_ue"}), @ORM\Index(name="fk_inscriptions_ues_types_note_idx", columns={"id_type_note"})})
 * @ORM\Entity
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
     * @var \Etudiants
     *
     * @ORM\ManyToOne(targetEntity="Etudiants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $idEtudiant;

    /**
     * @var \TypesNote
     *
     * @ORM\ManyToOne(targetEntity="TypesNote")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id")
     * })
     */
    private $idTypeNote;

    /**
     * @var \PeriodesUes
     *
     * @ORM\ManyToOne(targetEntity="PeriodesUes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours_ue", referencedColumnName="id")
     * })
     */
    private $idParcoursUe;

    /**
     * @var \TypesResultat
     *
     * @ORM\ManyToOne(targetEntity="TypesResultat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_resultat", referencedColumnName="id")
     * })
     */
    private $idTypeResultat;


}
