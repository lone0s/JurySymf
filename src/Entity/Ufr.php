<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ufrs
 *
 * @ORM\Table(
 *     name="ufrs",
 *     indexes={
 *         @ORM\Index(name="fk_ufrs_universites_1_idx", columns={"id_universite"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UfrRepository")
 */
class Ufr
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
     * @ORM\Column(name="denomination_courte", type="string", length=20, nullable=true, options={"default"=null})
     */
    private $denominationCourte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @var Universite
     *
     * @ORM\ManyToOne(targetEntity="Universite", inversedBy = "ufrs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_universite", referencedColumnName="id", nullable=false)
     * })
     */
    private $universite;

    /**
     * @ORM\OneToMany(targetEntity=Mention::class, mappedBy="ufr")
     */
    private $mentions;


    // *******************************************************************
    public function __construct()
    {
        $this->denominationCourte = null;
        $this->commentaire = null;
        $this->mentions = new ArrayCollection();
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
     * @return Collection<int, Mention>
     */
    public function getMentions(): Collection
    {
        return $this->mentions;
    }

    public function addMention(Mention $mention): self
    {
        if (!$this->mentions->contains($mention)) {
            $this->mentions[] = $mention;
            $mention->setUfr($this);
        }

        return $this;
    }

    public function removeMention(Mention $mention): self
    {
        if ($this->mentions->removeElement($mention)) {
            // set the owning side to null (unless already changed)
            if ($mention->getUfr() === $this) {
                $mention->setUfr(null);
            }
        }

        return $this;
    }

}
