<?php

namespace App\Entity;

use App\Repository\ParcoursUesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcoursUesRepository::class)
 */
class ParcoursUes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Periodes::class, inversedBy="idParcoursUe")
     */
    private $idPeriode;

    /**
     * @ORM\ManyToOne(targetEntity=Ues::class, inversedBy="idParcoursUe")
     */
    private $idUe;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="idParcoursUe")
     */
    private $idInscriptionUe;


    /**
     * @ORM\OneToMany(targetEntity=InscriptionsEpreuves::class, mappedBy="idParcoursUe")
     */
    private $idInscriptionEpreuve;
}
