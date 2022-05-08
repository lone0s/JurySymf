<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Parcours
 *
 * @ORM\Table(name="parcours", indexes=
 *     {@ORM\Index(name="fk_parcours_periodicites_idx", columns={"id_periodicite"})})
 * @ORM\Entity(repositoryClass="App\Repository\ParcoursRepository")
 */
class Parcours
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
     * @ORM\Column(name="nom_court", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $nomCourt = 'NULL';

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
     * @ORM\Column(name="code_apogee", type="string", length=30, nullable=true, options={"default"="NULL"})
     */
    private $codeApogee = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default"="1"})
     */
    private $actif = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @var Periodicite
     *
     * @ORM\ManyToOne(targetEntity="Periodicite", inversedBy = "parcours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_periodicite", referencedColumnName="id")
     * })
     */
    private $periodicite;


    /**
     * @ORM\OneToMany(targetEntity=MentionsParcours::class, mappedBy="parcours")
     */
    private $mentionParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="parcours")
     */
    private $inscriptionParcours;

    /**
     * @ORM\OneToMany(targetEntity=Periodes::class, mappedBy="parcours")
     */
    private $periode;

    public function __construct()
    {
        $this->mentionParcours = new ArrayCollection();
        $this->inscriptionParcours = new ArrayCollection();
        $this->periode = new ArrayCollection();
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
     * @return Collection<int, MentionsParcours>
     */
    public function getMentionParcours(): Collection
    {
        return $this->mentionParcours;
    }

    public function addIdMentionParcour(MentionsParcours $idMentionParcour): self
    {
        if (!$this->mentionParcours->contains($idMentionParcour)) {
            $this->mentionParcours[] = $idMentionParcour;
            $idMentionParcour->setParcours($this);
        }

        return $this;
    }

    public function removeIdMentionParcour(MentionsParcours $idMentionParcour): self
    {
        if ($this->mentionParcours->removeElement($idMentionParcour)) {
            // set the owning side to null (unless already changed)
            if ($idMentionParcour->getParcours() === $this) {
                $idMentionParcour->setParcours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsParcours>
     */
    public function getInscriptionParcours(): Collection
    {
        return $this->inscriptionParcours;
    }

    public function addIdInscriptionParcour(InscriptionsParcours $idInscriptionParcour): self
    {
        if (!$this->inscriptionParcours->contains($idInscriptionParcour)) {
            $this->inscriptionParcours[] = $idInscriptionParcour;
            $idInscriptionParcour->setParcours($this);
        }

        return $this;
    }

    public function removeIdInscriptionParcour(InscriptionsParcours $idInscriptionParcour): self
    {
        if ($this->inscriptionParcours->removeElement($idInscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionParcour->getParcours() === $this) {
                $idInscriptionParcour->setParcours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Periodes>
     */
    public function getPeriode(): Collection
    {
        return $this->periode;
    }

    public function addIdPeriode(Periodes $idPeriode): self
    {
        if (!$this->periode->contains($idPeriode)) {
            $this->periode[] = $idPeriode;
            $idPeriode->setParcours($this);
        }

        return $this;
    }

    public function removeIdPeriode(Periodes $idPeriode): self
    {
        if ($this->periode->removeElement($idPeriode)) {
            // set the owning side to null (unless already changed)
            if ($idPeriode->getParcours() === $this) {
                $idPeriode->setParcours(null);
            }
        }

        return $this;
    }
}
