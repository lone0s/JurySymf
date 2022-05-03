<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etudiants
 *
 * @ORM\Table(name="etudiants", uniqueConstraints={@ORM\UniqueConstraint(name="numero_UNIQUE", columns={"numero"})})
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantsRepository")
 */
class Etudiants
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
     * @ORM\Column(name="email", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $email = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $commentaire = 'NULL';

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsParcours::class, mappedBy="etudiant")
     */
    private $inscriptionParcours;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsPeriodes::class, mappedBy="etudiant")
     */
    private $inscriptionPeriode;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsUes::class, mappedBy="etudiant")
     */
    private $inscriptionUe;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionsEpreuves::class, mappedBy="etudiant")
     */
    private $inscriptionEpreuve;

    public function __construct()
    {
        $this->inscriptionParcours = new ArrayCollection();
        $this->inscriptionPeriode = new ArrayCollection();
        $this->inscriptionUe = new ArrayCollection();
        $this->inscriptionEpreuve = new ArrayCollection();
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
            $idInscriptionParcour->setEtudiant($this);
        }

        return $this;
    }

    public function removeIdInscriptionParcour(InscriptionsParcours $idInscriptionParcour): self
    {
        if ($this->inscriptionParcours->removeElement($idInscriptionParcour)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionParcour->getEtudiant() === $this) {
                $idInscriptionParcour->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsPeriodes>
     */
    public function getInscriptionPeriode(): Collection
    {
        return $this->inscriptionPeriode;
    }

    public function addIdInscriptionPeriode(InscriptionsPeriodes $idInscriptionPeriode): self
    {
        if (!$this->inscriptionPeriode->contains($idInscriptionPeriode)) {
            $this->inscriptionPeriode[] = $idInscriptionPeriode;
            $idInscriptionPeriode->setEtudiant($this);
        }

        return $this;
    }

    public function removeIdInscriptionPeriode(InscriptionsPeriodes $idInscriptionPeriode): self
    {
        if ($this->inscriptionPeriode->removeElement($idInscriptionPeriode)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionPeriode->getEtudiant() === $this) {
                $idInscriptionPeriode->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsUes>
     */
    public function getInscriptionUe(): Collection
    {
        return $this->inscriptionUe;
    }

    public function addIdInscriptionUe(InscriptionsUes $idInscriptionUe): self
    {
        if (!$this->inscriptionUe->contains($idInscriptionUe)) {
            $this->inscriptionUe[] = $idInscriptionUe;
            $idInscriptionUe->setEtudiant($this);
        }

        return $this;
    }

    public function removeIdInscriptionUe(InscriptionsUes $idInscriptionUe): self
    {
        if ($this->inscriptionUe->removeElement($idInscriptionUe)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionUe->getEtudiant() === $this) {
                $idInscriptionUe->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InscriptionsEpreuves>
     */
    public function getInscriptionEpreuve(): Collection
    {
        return $this->inscriptionEpreuve;
    }

    public function addIdInscriptionEpreuve(InscriptionsEpreuves $idInscriptionEpreuve): self
    {
        if (!$this->inscriptionEpreuve->contains($idInscriptionEpreuve)) {
            $this->inscriptionEpreuve[] = $idInscriptionEpreuve;
            $idInscriptionEpreuve->setEtudiant($this);
        }

        return $this;
    }

    public function removeIdInscriptionEpreuve(InscriptionsEpreuves $idInscriptionEpreuve): self
    {
        if ($this->inscriptionEpreuve->removeElement($idInscriptionEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($idInscriptionEpreuve->getEtudiant() === $this) {
                $idInscriptionEpreuve->setEtudiant(null);
            }
        }

        return $this;
    }
}
