<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Universite
 *
 * @ORM\Table(name="universites")
 * @ORM\Entity(repositoryClass="App\Repository\UniversiteRepository")
 */
class Universite
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
     * @ORM\Column(name="nom", type="string", length=200, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=Ufrs::class, mappedBy="universite")
     */
    private $ufrs;


    // *******************************************************************
    public function __construct()
    {
        $this->commentaire = null;
        $this->ufrs = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    /**
     * @return Collection<int, Ufrs>
     */
    public function getUfrs(): Collection
    {
        return $this->ufrs;
    }

    public function addUfr(Ufrs $ufr): self
    {
        if (!$this->ufrs->contains($ufr)) {
            $this->ufrs[] = $ufr;
            $ufr->setUniversite($this);
        }

        return $this;
    }

    public function removeUfr(Ufrs $ufr): self
    {
        if ($this->ufrs->removeElement($ufr)) {
            // set the owning side to null (unless already changed)
            if ($ufr->getUniversite() === $this) {
                $ufr->setUniversite(null);
            }
        }

        return $this;
    }

}
