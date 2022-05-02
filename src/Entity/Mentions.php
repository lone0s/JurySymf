<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mentions
 *
 * @ORM\Table(name="mentions", indexes={@ORM\Index(name="fk_mentions_ufrs_1_idx", columns={"id_ufr"}), @ORM\Index(name="fk_mentions_diplomes_1_idx", columns={"id_diplome"})})
 * @ORM\Entity
 */
class Mentions
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
     * @ORM\Column(name="annee_debut", type="integer", nullable=false)
     */
    private $anneeDebut;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_fin", type="integer", nullable=false)
     */
    private $anneeFin;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default"="1","comment"="booléen"})
     */
    private $actif = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @var \Diplomes
     *
     * @ORM\ManyToOne(targetEntity="Diplomes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diplome", referencedColumnName="id")
     * })
     */
    private $idDiplome;

    /**
     * @var \Ufrs
     *
     * @ORM\ManyToOne(targetEntity="Ufrs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ufr", referencedColumnName="id")
     * })
     */
    private $idUfr;


}
