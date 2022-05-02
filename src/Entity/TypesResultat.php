<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypesResultat
 *
 * @ORM\Table(name="types_resultat", uniqueConstraints={@ORM\UniqueConstraint(name="types_resultatcol_UNIQUE", columns={"type"})})
 * @ORM\Entity
 */
class TypesResultat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="n'est pas auto-incrémenté (cf. commentaire de la table)"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="idTypeResultat")
     */
    private $idInscriptionParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="idTypeResultat")
     */
    private $idInscriptionPeriode;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="idTypeResultat")
     */
    private $idInscriptionUe;

}
