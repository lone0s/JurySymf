<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Mention
 *
 * @ORM\Table(
 *     name="mentions",
 *     indexes={
 *         @ORM\Index(name="fk_mentions_ufrs_1_idx", columns={"id_ufr"}),
 *         @ORM\Index(name="fk_mentions_diplomes_1_idx", columns={"id_diplome"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\MentionRepository")
 */
class Mention
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
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_court", type="string", length=20, nullable=true, options={"default"=null})
     */
    private $nomCourt;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_debut", type="integer", nullable=false)
     */
    private $anneeDebut;

    /**
     * @var int
     *
     * @ORM\Column(name="annee_fin", type="integer", nullable=false)
     */
    private $anneeFin;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default"=true, "comment"="booléen"})
     */
    private $actif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @var Diplome
     *
     * @ORM\ManyToOne(targetEntity="Diplome",inversedBy="mentions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diplome", referencedColumnName="id", nullable=false)
     * })
     */
    private $diplome;

    /**
     * @var Ufr
     *
     * @ORM\ManyToOne(targetEntity="Ufr",inversedBy="mentions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ufr", referencedColumnName="id", nullable=false)
     * })
     */
    private $ufr;


    /**
     * @ORM\OneToMany(targetEntity=MentionParcour::class, mappedBy="mention")
     */
    private $mentionsParcours;


    // *******************************************************************
    public function __construct()
    {
        $this->nomCourt = null;
        $this->actif = true;
        $this->commentaire = null;
        $this->mentionsParcours = new ArrayCollection();
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

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(?string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

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

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

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

    public function getDiplome(): ?Diplome
    {
        return $this->diplome;
    }

    public function setDiplome(?Diplome $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getUfr(): ?Ufr
    {
        return $this->ufr;
    }

    public function setUfr(?Ufr $ufr): self
    {
        $this->ufr = $ufr;

        return $this;
    }

    /**
     * @return Collection<int, MentionParcour>
     */
    public function getMentionsParcours(): Collection
    {
        return $this->mentionsParcours;
    }

    public function addMentionParcour(MentionParcour $mentionParcour): self
    {
        if (!$this->mentionsParcours->contains($mentionParcour)) {
            $this->mentionsParcours[] = $mentionParcour;
            $mentionParcour->setMention($this);
        }

        return $this;
    }

    public function removeMentionParcour(MentionParcour $mentionParcour): self
    {
        if ($this->mentionsParcours->removeElement($mentionParcour)) {
            // set the owning side to null (unless already changed)
            if ($mentionParcour->getMention() === $this) {
                $mentionParcour->setMention(null);
            }
        }

        return $this;
    }

}
