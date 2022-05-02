<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeriodesUes
 *
 * @ORM\Table(name="periodes_ues", uniqueConstraints={@ORM\UniqueConstraint(name="index4", columns={"id_ue", "id_periode"})}, indexes={@ORM\Index(name="fk_pu_ues_idx", columns={"id_ue"}), @ORM\Index(name="fk_pu_periodes_idx", columns={"id_periode"})})
 * @ORM\Entity
 */
class PeriodesUes
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
     * @var float|null
     *
     * @ORM\Column(name="note_eliminatoire", type="float", precision=10, scale=0, nullable=true, options={"default"="NULL"})
     */
    private $noteEliminatoire = NULL;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer", nullable=false, options={"comment"="ordre d'affichage"})
     */
    private $rang;

    /**
     * @var \Periodes
     *
     * @ORM\ManyToOne(targetEntity="Periodes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periode", referencedColumnName="id")
     * })
     */
    private $idPeriode;

    /**
     * @var \Ues
     *
     * @ORM\ManyToOne(targetEntity="Ues")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ue", referencedColumnName="id")
     * })
     */
    private $idUe;


}
