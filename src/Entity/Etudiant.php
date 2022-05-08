<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etudiants
 *
 * @ORM\Table(
 *     name="etudiants",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="numero_UNIQUE", columns={"numero"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
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
     * @ORM\Column(name="numero", type="string", length=30, nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=false)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true, options={"default"=null})
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"=null})
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionParcour::class, mappedBy="etudiant")
     */
    private $inscriptionsParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="etudiant")
     */
    private $inscriptionsPeriodes;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="etudiant")
     */
    private $inscriptionsUes;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionEpreuve::class, mappedBy="etudiant")
     */
    private $inscriptionsEpreuves;


    // *******************************************************************
   public function __construct()
    {
        $this->email = null;
        $this->commentaire = null;
        $this->inscriptionsParcours = new ArrayCollection();
        $this->inscriptionsPeriodes = new ArrayCollection();
        $this->inscriptionsUes = new ArrayCollection();
        $this->inscriptionsEpreuves = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
     * @return Collection<int, InscriptionParcour>
     */
    public function getInscriptionsParcours(): Collection
    {
        return $this->inscriptionsParcours;
    }

    public function addInscriptionParcour(InscriptionParcour $inscriptionParcour): self
    {
        if (!$this->inscriptionsParcours->contains($inscriptionParcour)) {
            $this->inscriptionsParcours[] = $inscriptionParcour;
            $inscriptionParcour->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscriptionParcour(InscriptionParcour $inscriptionParcour): self
    {
        if ($this->inscriptionsParcours->removeElement($inscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionParcour->getEtudiant() === $this) {
                $inscriptionParcour->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsPeriodes>
     */
    public function getInscriptionsPeriodes(): Collection
    {
        return $this->inscriptionsPeriodes;
    }

    public function addInscriptionPeriode(InscriptionsPeriodes $inscriptionPeriode): self
    {
        if (!$this->inscriptionsPeriodes->contains($inscriptionPeriode)) {
            $this->inscriptionsPeriodes[] = $inscriptionPeriode;
            $inscriptionPeriode->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscriptionPeriode(InscriptionsPeriodes $inscriptionPeriode): self
    {
        if ($this->inscriptionsPeriodes->removeElement($inscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionPeriode->getEtudiant() === $this) {
                $inscriptionPeriode->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsUes>
     */
    public function getInscriptionsUes(): Collection
    {
        return $this->inscriptionsUes;
    }

    public function addInscriptionUe(InscriptionsUes $inscriptionUe): self
    {
        if (!$this->inscriptionsUes->contains($inscriptionUe)) {
            $this->inscriptionsUes[] = $inscriptionUe;
            $inscriptionUe->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscriptionUe(InscriptionsUes $inscriptionUe): self
    {
        if ($this->inscriptionsUes->removeElement($inscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionUe->getEtudiant() === $this) {
                $inscriptionUe->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionEpreuve>
     */
    public function getInscriptionsEpreuves(): Collection
    {
        return $this->inscriptionsEpreuves;
    }

    public function addInscriptionEpreuve(InscriptionEpreuve $inscriptionEpreuve): self
    {
        if (!$this->inscriptionsEpreuves->contains($inscriptionEpreuve)) {
            $this->inscriptionsEpreuves[] = $inscriptionEpreuve;
            $inscriptionEpreuve->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscriptionEpreuve(InscriptionEpreuve $inscriptionEpreuve): self
    {
        if ($this->inscriptionsEpreuves->removeElement($inscriptionEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionEpreuve->getEtudiant() === $this) {
                $inscriptionEpreuve->setEtudiant(null);
            }
        }

        return $this;
    }
}
