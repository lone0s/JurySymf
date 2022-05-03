<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Universites
 *
 * @ORM\Table(name="universites")
 * @ORM\Entity(repositoryClass="App\Repository\UniversitesRepository")
 */
class Universites
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
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @ORM\OneToMany(targetEntity=Ufrs::class, mappedBy="idUniversite")
     */
    private $idUfr;

    public function __construct()
    {
        $this->idUfr = new ArrayCollection();
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
    public function getIdUfr(): Collection
    {
        return $this->idUfr;
    }

    public function addIdUfr(Ufrs $idUfr): self
    {
        if (!$this->idUfr->contains($idUfr)) {
            $this->idUfr[] = $idUfr;
            $idUfr->setIdUniversite($this);
        }

        return $this;
    }

    public function removeIdUfr(Ufrs $idUfr): self
    {
        if ($this->idUfr->removeElement($idUfr)) {
            // set the owning side to null (unless already changed)
            if ($idUfr->getIdUniversite() === $this) {
                $idUfr->setIdUniversite(null);
            }
        }

        return $this;
    }

}
