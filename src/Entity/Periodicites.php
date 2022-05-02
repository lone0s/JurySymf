<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periodicites
 *
 * @ORM\Table(name="periodicites")
 * @ORM\Entity
 */
class Periodicites
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
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_court", type="string", length=10, nullable=false)
     */
    private $nomCourt;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre", type="integer", nullable=false, options={"comment"="nombre de sous-périodes dans l'annéee"})
     */
    private $nombre;


}
