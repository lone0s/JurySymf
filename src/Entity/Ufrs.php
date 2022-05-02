<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ufrs
 *
 * @ORM\Table(name="ufrs", indexes={@ORM\Index(name="fk_ufrs_universites_1_idx", columns={"id_universite"})})
 * @ORM\Entity
 */
class Ufrs
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
     * @ORM\Column(name="denomination", type="string", length=200, nullable=false)
     */
    private $denomination;

    /**
     * @var string|null
     *
     * @ORM\Column(name="denomination_courte", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $denominationCourte = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @var Universites
     *
     * @ORM\ManyToOne(targetEntity="Universites", inversedBy = "idUfr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_universite", referencedColumnName="id")
     * })
     */
    private $idUniversite;

    /**
     * @ORM\OneToMany(targetEntity=mentions::class, mappedBy="idUfr")
     */
    private $idMention ;

}
