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
     * @var Universites
     *
     * @ORM\ManyToOne(targetEntity="Universites", inversedBy = "idUfr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_universite", referencedColumnName="id")
     * })
     */
    private $idUniversite;

    /**
     * @ORM\OneToMany(targetEntity=mentions::class, mappedBy="idUfr")
     */
    private $idMention ;

    public function __construct()
    {
        $this->idMention = new ArrayCollection();
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

    public function getIdUniversite(): ?Universites
    {
        return $this->idUniversite;
    }

    public function setIdUniversite(?Universites $idUniversite): self
    {
        $this->idUniversite = $idUniversite;

        return $this;
    }

    /**
     * @return Collection<int, mentions>
     */
    public function getIdMention(): Collection
    {
        return $this->idMention;
    }

    public function addIdMention(mentions $idMention): self
    {
        if (!$this->idMention->contains($idMention)) {
            $this->idMention[] = $idMention;
            $idMention->setUfr($this);
        }

        return $this;
    }

    public function removeIdMention(mentions $idMention): self
    {
        if ($this->idMention->removeElement($idMention)) {
            // set the owning side to null (unless already changed)
            if ($idMention->getUfr() === $this) {
                $idMention->setUfr(null);
            }
        }

        return $this;
    }

}
