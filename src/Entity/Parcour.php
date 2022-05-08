<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Parcour
 *
 * @ORM\Table(
 *     name="parcours",
 *     indexes={
 *         @ORM\Index(name="fk_parcours_periodicites_idx", columns={"id_periodicite"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ParcourRepository")
 *
 * Singulier avec faute d'orthographe voulu
 */
class Parcour
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
     * @ORM\Column(name="annee", type="integer", nullable=false)
     */
    private $annee;

    /**
     * @var bool
     *
     * @ORM\Column(name="compensation", type="boolean", nullable=false, options={"comment"="booléen : compensation entre les périodes"})
     */
    private $compensation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"=null})
     */
    private $codeApogee;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default"=true})
     */
    private $actif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @var Periodicite
     *
     * @ORM\ManyToOne(targetEntity="Periodicite", inversedBy = "parcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periodicite", referencedColumnName="id", nullable=false)
     * })
     */
    private $periodicite;

    /**
     * @ORM\OneToMany(targetEntity=MentionParcour::class, mappedBy="parcour")
     */
    private $mentionsParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="parcour")
     */
    private $inscriptionsParcours;

    /**
     * @ORM\OneToMany(targetEntity=Periodes::class, mappedBy="parcour")
     */
    private $periodes;


    // *******************************************************************
    public function __construct()
    {
        $this->nomCourt = null;
        $this->codeApogee = null;
        $this->actif = true;
        $this->commentaire = null;
        $this->mentionsParcours = new ArrayCollection();
        $this->inscriptionsParcours = new ArrayCollection();
        $this->periodes = new ArrayCollection();
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

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCompensation(): ?bool
    {
        return $this->compensation;
    }

    public function setCompensation(bool $compensation): self
    {
        $this->compensation = $compensation;

        return $this;
    }

    public function getCodeApogee(): ?string
    {
        return $this->codeApogee;
    }

    public function setCodeApogee(?string $codeApogee): self
    {
        $this->codeApogee = $codeApogee;

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

    public function getPeriodicite(): ?Periodicite
    {
        return $this->periodicite;
    }

    public function setPeriodicite(?Periodicite $periodicite): self
    {
        $this->periodicite = $periodicite;

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
            $mentionParcour->setParcour($this);
        }

        return $this;
    }

    public function removeMentionParcour(MentionParcour $mentionParcour): self
    {
        if ($this->mentionsParcours->removeElement($mentionParcour)) {
            // set the owning side to null (unless already changed)
            if ($mentionParcour->getParcour() === $this) {
                $mentionParcour->setParcour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsParcours>
     */
    public function getInscriptionsParcours(): Collection
    {
        return $this->inscriptionsParcours;
    }

    public function addInscriptionParcour(InscriptionsParcours $inscriptionParcour): self
    {
        if (!$this->inscriptionsParcours->contains($inscriptionParcour)) {
            $this->inscriptionsParcours[] = $inscriptionParcour;
            $inscriptionParcour->setParcour($this);
        }

        return $this;
    }

    public function removeInscriptionParcour(InscriptionsParcours $inscriptionParcour): self
    {
        if ($this->inscriptionsParcours->removeElement($inscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionParcour->getParcour() === $this) {
                $inscriptionParcour->setParcour(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Periodes>
     */
    public function getPeriodes(): Collection
    {
        return $this->periodes;
    }

    public function addPeriode(Periodes $periode): self
    {
        if (!$this->periodes->contains($periode)) {
            $this->periodes[] = $periode;
            $periode->setParcour($this);
        }

        return $this;
    }

    public function removePeriode(Periodes $periode): self
    {
        if ($this->periodes->removeElement($periode)) {
            // set the owning side to null (unless already changed)
            if ($periode->getParcour() === $this) {
                $periode->setParcour(null);
            }
        }

        return $this;
    }
}
