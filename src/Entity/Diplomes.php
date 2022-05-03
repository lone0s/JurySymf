<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Diplomes
 *
 * @ORM\Table(name="diplomes")
 * @ORM\Entity(repositoryClass="App\Repository\DiplomesRepository")
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
     * @ORM\OneToMany(targetEntity=Mentions::class, mappedBy="diplome", orphanRemoval=true)
     */
    private $mention;

    public function __construct()
    {
        $this->mention = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getLibelleCourt(): ?string
    {
        return $this->libelleCourt;
    }

    public function setLibelleCourt(string $libelleCourt): self
    {
        $this->libelleCourt = $libelleCourt;

        return $this;
    }

    public function getAnneeDebut(): ?int
    {
        return $this->anneeDebut;
    }

    public function setAnneeDebut(int $anneeDebut): self
    {
        $this->anneeDebut = $anneeDebut;

        return $this;
    }

    public function getAnneeFin(): ?int
    {
        return $this->anneeFin;
    }

    public function setAnneeFin(int $anneeFin): self
    {
        $this->anneeFin = $anneeFin;

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
     * @return Collection<int, Mentions>
     */
    public function getMention(): Collection
    {
        return $this->mention;
    }

    public function addIdMention(Mentions $idMention): self
    {
        if (!$this->mention->contains($idMention)) {
            $this->mention[] = $idMention;
            $idMention->setDiplome($this);
        }

        return $this;
    }

    public function removeIdMention(Mentions $idMention): self
    {
        if ($this->mention->removeElement($idMention)) {
            // set the owning side to null (unless already changed)
            if ($idMention->getDiplome() === $this) {
                $idMention->setDiplome(null);
            }
        }

        return $this;
    }

}
