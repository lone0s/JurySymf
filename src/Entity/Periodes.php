<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Periodes
 *
 * @ORM\Table(name="periodes", indexes={@ORM\Index(name="fk_periodes_parcours_idx", columns={"id_parcours"})})
 * @ORM\Entity
 */
class Periodes
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
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $codeApogee = 'NULL';

    /**
     * @var Parcours
     *
     * @ORM\ManyToOne(targetEntity="Parcours", inversedBy="idPeriode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id")
     * })
     */
    private $idParcours;


    /**
     * @var PeriodesUes
     *
     * @ORM\ManyToOne(targetEntity="PeriodesUes", inversedBy="idPeriode")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id")
     * })
     */
    private $idPeriodeUe;

    /**
     * @ORM\OneToMany(targetEntity=ParcoursUes::class, mappedBy="idPeriode")
     */
    private $idParcoursUe;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="idPeriode")
     */
    private $idInscriptionPeriode;

}
