<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Parcours
 *
 * @ORM\Table(name="parcours", indexes={@ORM\Index(name="fk_parcours_periodicites_idx", columns={"id_periodicite"})})
 * @ORM\Entity
 */
class Parcours
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_court", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $nomCourt = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="annee", type="integer", nullable=false)
     */
    private $annee;

    /**
     * @var bool
     *
     * @ORM\Column(name="compensation", type="boolean", nullable=false, options={"comment"="booléen : compensation entre les périodes"})
     */
    private $compensation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $codeApogee = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default"="1"})
     */
    private $actif = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @var Periodicites
     *
     * @ORM\ManyToOne(targetEntity="Periodicites", inversedBy = "idParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periodicite", referencedColumnName="id")
     * })
     */
    private $idPeriodicite;


    /**
     * @ORM\OneToMany(targetEntity=MentionsParcours::class, mappedBy="idParcours")
     */
    private $idMentionParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="idParcours")
     */
    private $idInscriptionParcours;

    /**
     * @ORM\OneToMany(targetEntity=Periodes::class, mappedBy="idParcours")
     */
    private $idPeriode;
}
