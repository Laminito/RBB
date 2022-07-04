<?php

namespace App\Entity;

use App\Entity\Produit;
use App\Entity\Gestionnaire;
use App\Entity\LigneDeCommande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type:"string")]
#[ORM\DiscriminatorMap([
    "burger"         =>  "Burger",
    "menu"           =>  "Menu",
    "portionfrite"   =>   "PortionFrite",
    "boisson"        =>  "Boisson",
])]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nomprod;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $imageprod;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'produits')]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: LigneDeCommande::class)]
    private $ligneDeCommandes;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $etatprod;

    public function __construct()
    {
        $this->ligneDeCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomprod(): ?string
    {
        return $this->nomprod;
    }

    public function setNomprod(?string $nomprod): self
    {
        $this->nomprod = $nomprod;

        return $this;
    }

    public function getImageprod()
    {
        return $this->imageprod;
    }

    public function setImageprod($imageprod): self
    {
        $this->imageprod = $imageprod;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    /**
     * @return Collection<int, LigneDeCommande>
     */
    public function getLigneDeCommandes(): Collection
    {
        return $this->ligneDeCommandes;
    }

    public function addLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if (!$this->ligneDeCommandes->contains($ligneDeCommande)) {
            $this->ligneDeCommandes[] = $ligneDeCommande;
            $ligneDeCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if ($this->ligneDeCommandes->removeElement($ligneDeCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDeCommande->getProduit() === $this) {
                $ligneDeCommande->setProduit(null);
            }
        }

        return $this;
    }

    public function isEtatprod(): ?bool
    {
        return $this->etatprod;
    }

    public function setEtatprod(?bool $etatprod): self
    {
        $this->etatprod = $etatprod;

        return $this;
    }
}
