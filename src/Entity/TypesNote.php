<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypesNote
 *
 * @ORM\Table(name="types_note", uniqueConstraints={@ORM\UniqueConstraint(name="type_UNIQUE", columns={"type"})})
 * @ORM\Entity
 */
class TypesNote
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


}
