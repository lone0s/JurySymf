<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NaturesEpreuve
 *
 * @ORM\Table(name="natures_epreuve")
 * @ORM\Entity
 */
class NaturesEpreuve
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
     * @ORM\Column(name="nature", type="string", length=50, nullable=false)
     */
    private $nature;

    /**
     * @ORM\OneToMany(targetEntity=Epreuves::class, mappedBy="idNatureEpreuve")
     */
    private $idEpreuve;

}
