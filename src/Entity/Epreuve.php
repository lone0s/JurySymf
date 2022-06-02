<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Epreuve
 *
 * @ORM\Table(
 *     name="epreuves",
 *     indexes={
 *         @ORM\Index(name="fk_epreuves_natures_epreuve_idx", columns={"id_nature"}),
 *         @ORM\Index(name="fk_epreuves_ues_idx", columns={"id_ue"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\EpreuveRepository")
 */
class Epreuve
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
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="coefficient", type="float", precision=10, scale=0, nullable=false)
     */
    private $coefficient;

    /**
     * @var int
     *
     * @ORM\Column(name="rang", type="integer", nullable=false)
     */
    private $rang;

    /**
     * @var bool
     *
     * @ORM\Column(name="session1", type="boolean", nullable=false, options={"comment"="booléen"})
     */
    private $session1;

    /**
     * @var bool
     *
     * @ORM\Column(name="session2", type="boolean", nullable=false, options={"comment"="booléen"})
     */
    private $session2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="duree", type="string", length=20, nullable=true, options={"default"=null})
     */
    private $duree;

    /**
     * @var NatureEpreuve
     *
     * @ORM\ManyToOne(targetEntity="NatureEpreuve", inversedBy = "epreuves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nature", referencedColumnName="id", nullable = true)
     * })
     */
    private $natureEpreuve;

    /**
     * @var Ue
     *
     * @ORM\ManyToOne(targetEntity="Ue", inversedBy = "epreuves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ue", referencedColumnName="id", nullable = false)
     * })
     */
    private $ue;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionEpreuve::class, mappedBy="epreuve")
     */
    private $inscriptionsEpreuves;


    // *******************************************************************
    public function __construct()
    {
        $this->duree = null;
        $this->natureEpreuve = null;
        $this->inscriptionsEpreuves = new ArrayCollection();
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

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(float $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getSession1(): ?bool
    {
        return $this->session1;
    }

    public function setSession1(bool $session1): self
    {
        $this->session1 = $session1;

        return $this;
    }

    public function getSession2(): ?bool
    {
        return $this->session2;
    }

    public function setSession2(bool $session2): self
    {
        $this->session2 = $session2;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNatureEpreuve(): ?NatureEpreuve
    {
        return $this->natureEpreuve;
    }

    public function setNatureEpreuve(?NatureEpreuve $natureEpreuve): self
    {
        $this->natureEpreuve = $natureEpreuve;

        return $this;
    }

    public function getUe(): ?Ue
    {
        return $this->ue;
    }

    public function setUe(?Ue $ue): self
    {
        $this->ue = $ue;

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
            $inscriptionEpreuve->setEpreuve($this);
        }

        return $this;
    }

    public function removeInscriptionEpreuve(InscriptionEpreuve $inscriptionEpreuve): self
    {
        if ($this->inscriptionsEpreuves->removeElement($inscriptionEpreuve)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionEpreuve->getEpreuve() === $this) {
                $inscriptionEpreuve->setEpreuve(null);
            }
        }

        return $this;
    }

    public function checkSession(): int {
        if ($this -> session1 === true) {
            return 1;
        }
        return 2;
    }
}
