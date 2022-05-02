<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionsParcours
 *
 * @ORM\Table(name="inscriptions_parcours", uniqueConstraints={@ORM\UniqueConstraint(name="index4", columns={"id_etudiant", "id_parcours"})}, indexes={@ORM\Index(name="fk_inscriptions_parcours_types_resultat_idx", columns={"id_type_resultat"}), @ORM\Index(name="fk_inscriptions_parcours_etudiants_idx", columns={"id_etudiant"}), @ORM\Index(name="fk_inscriptions_parcours_parcours_idx", columns={"id_parcours"}), @ORM\Index(name="fk_inscriptions_parcours_types_note_idx", columns={"id_type_note"})})
 * @ORM\Entity
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
     * @var Etudiants
     *
     * @ORM\ManyToOne(targetEntity="Etudiants", inversedBy = "idInscriptionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etudiant", referencedColumnName="id")
     * })
     */
    private $idEtudiant;

    /**
     * @var TypesNote
     *
     * @ORM\ManyToOne(targetEntity="TypesNote", inversedBy = "idInscriptionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_note", referencedColumnName="id")
     * })
     */
    private $idTypeNote;

    /**
     * @var Parcours
     *
     * @ORM\ManyToOne(targetEntity="Parcours", inversedBy = "idInscriptionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id")
     * })
     */
    private $idParcours;

    /**
     * @var TypesResultat
     *
     * @ORM\ManyToOne(targetEntity="TypesResultat", inversedBy = "idInscriptionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type_resultat", referencedColumnName="id")
     * })
     */
    private $idTypeResultat;
}
