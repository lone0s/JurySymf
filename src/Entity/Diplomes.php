<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Diplomes
 *
 * @ORM\Table(name="diplomes")
 * @ORM\Entity
 */
class Diplomes
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
     * @ORM\Column(name="libelle", type="string", length=50, nullable=false)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_court", type="string", length=20, nullable=false)
     */
    private $libelleCourt;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_debut", type="integer", nullable=false, options={"comment"="nombre d'années après le bac pour le début de la formation du diplôme, par exemple 4 pour un master"})
     */
    private $anneeDebut;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_fin", type="integer", nullable=false, options={"comment"="nombre d'années après le bac pour la délivrance du diplôme, par exemple 5 pour un master"})
     */
    private $anneeFin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @ORM\OneToMany(targetEntity=Mentions::class, mappedBy="idDiplome", orphanRemoval=true)
     */
    private $idMention;

}
