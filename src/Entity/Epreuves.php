<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Epreuves
 *
 * @ORM\Table(name="epreuves", indexes={@ORM\Index(name="fk_epreuves_natures_epreuve_idx", columns={"id_nature"}), @ORM\Index(name="fk_epreuves_ues_idx", columns={"id_ue"})})
 * @ORM\Entity
 */
class Epreuves
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
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="coefficient", type="float", precision=10, scale=0, nullable=false)
     */
    private $coefficient;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer", nullable=false)
     */
    private $rang;

    /**
     * @var bool
     *
     * @ORM\Column(name="session1", type="boolean", nullable=false, options={"comment"="booléen"})
     */
    private $session1;

    /**
     * @var bool
     *
     * @ORM\Column(name="session2", type="boolean", nullable=false, options={"comment"="booléen"})
     */
    private $session2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="duree", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $duree = 'NULL';

    /**
     * @var NaturesEpreuve
     *
     * @ORM\ManyToOne(targetEntity="NaturesEpreuve")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nature", referencedColumnName="id")
     * })
     */
    private $idNature;

    /**
     * @var Ues
     *
     * @ORM\ManyToOne(targetEntity="Ues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ue", referencedColumnName="id")
     * })
     */
    private $idUe;


}
