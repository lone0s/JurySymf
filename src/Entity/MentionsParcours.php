<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MentionsParcours
 *
 * @ORM\Table(name="mentions_parcours", uniqueConstraints=
 *     {@ORM\UniqueConstraint(name="index4", columns={"id_mention", "id_parcours"})},
 *     indexes={@ORM\Index(name="fk_mp_mentions_idx", columns={"id_mention"}),
 *     @ORM\Index(name="fk_mp_parcours_idx", columns={"id_parcours"})})
 * @ORM\Entity(repositoryClass="App\Repository\MentionsParcoursRepository")
 */
class MentionsParcours
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer", nullable=false, options={"comment"="ordre d'affichage"})
     */
    private $rang;

    /**
     * @var Mentions
     *
     * @ORM\ManyToOne(targetEntity="Mentions", inversedBy="mentionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mention", referencedColumnName="id")
     * })
     */
    private $mention;

    /**
     * @var Parcours
     *
     * @ORM\ManyToOne(targetEntity="Parcours", inversedBy="mentionParcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_parcours", referencedColumnName="id")
     * })
     */
    private $parcours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getMention(): ?Mentions
    {
        return $this->mention;
    }

    public function setMention(?Mentions $mention): self
    {
        $this->mention = $mention;

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): self
    {
        $this->parcours = $parcours;

        return $this;
    }
}
