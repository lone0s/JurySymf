<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ues
 *
 * @ORM\Table(name="ues")
 * @ORM\Entity
 */
class Ues
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
     * @var float
     *
     * @ORM\Column(name="ects", type="float", precision=10, scale=0, nullable=false, options={"comment"="crédits européens"})
     */
    private $ects;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $codeApogee = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @var PeriodesUes
     *
     * @ORM\ManyToOne(targetEntity="PeriodesUes", inversedBy="idUe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id")
     * })
     */
    private $idPeriodeUe;
    /**
     * @ORM\ManyToOne(targetEntity=Periodes::class, inversedBy="idUe")
     */
    private $idPeriodes;

    /**
     * @ORM\OneToMany(targetEntity=ParcoursUes::class, mappedBy="idUe")
     */
    private $idParcoursUe;

    /**
     * @ORM\OneToMany(targetEntity=Epreuves::class, mappedBy="idUe")
     */
    private $idEpreuve;


}
