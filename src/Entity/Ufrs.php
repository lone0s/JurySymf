<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ufrs
 *
 * @ORM\Table(name="ufrs", indexes={@ORM\Index(name="fk_ufrs_universites_1_idx", columns={"id_universite"})})
 * @ORM\Entity(repositoryClass="App\Repository\UfrsRepository")
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
     * @var Universite
     *
     * @ORM\ManyToOne(targetEntity="Universite", inversedBy = "ufrs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_universite", referencedColumnName="id")
     * })
     */
    private $universite;

    /**
     * @ORM\OneToMany(targetEntity=mentions::class, mappedBy="ufr")
     */
    private $mention ;

    public function __construct()
    {
        $this->mention = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getDenominationCourte(): ?string
    {
        return $this->denominationCourte;
    }

    public function setDenominationCourte(?string $denominationCourte): self
    {
        $this->denominationCourte = $denominationCourte;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getUniversite(): ?Universite
    {
        return $this->universite;
    }

    public function setUniversite(?Universite $universite): self
    {
        $this->universite = $universite;

        return $this;
    }

    /**
     * @return Collection<int, mentions>
     */
    public function getMention(): Collection
    {
        return $this->mention;
    }

    public function addIdMention(mentions $idMention): self
    {
        if (!$this->mention->contains($idMention)) {
            $this->mention[] = $idMention;
            $idMention->setUfr($this);
        }

        return $this;
    }

    public function removeIdMention(mentions $idMention): self
    {
        if ($this->mention->removeElement($idMention)) {
            // set the owning side to null (unless already changed)
            if ($idMention->getUfr() === $this) {
                $idMention->setUfr(null);
            }
        }

        return $this;
    }

}
