<?php

namespace App\Entity;

use App\Entity\Facture;
use Doctrine\ORM\Mapping\Id;
use App\Entity\LigneDeCommande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $etatFacture;

    #[ORM\OneToOne(inversedBy: 'facture', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private $commande;

    #[ORM\OneToOne(mappedBy: 'commande', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private $facture;

    #[ORM\OneToMany(mappedBy: 'facture', targetEntity: LigneDeCommande::class)]
    private $ligneDeCommandes;

    public function __construct()
    {
        $this->ligneDeCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEtatFacture(): ?bool
    {
        return $this->etatFacture;
    }

    public function setEtatFacture(?bool $etatFacture): self
    {
        $this->etatFacture = $etatFacture;

        return $this;
    }

    public function getCommande(): ?self
    {
        return $this->commande;
    }

    public function setCommande(?self $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getFacture(): ?self
    {
        return $this->facture;
    }

    public function setFacture(?self $facture): self
    {
        // unset the owning side of the relation if necessary
        if ($facture === null && $this->facture !== null) {
            $this->facture->setCommande(null);
        }

        // set the owning side of the relation if necessary
        if ($facture !== null && $facture->getCommande() !== $this) {
            $facture->setCommande($this);
        }

        $this->facture = $facture;

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
            $ligneDeCommande->setFacture($this);
        }

        return $this;
    }

    public function removeLigneDeCommande(LigneDeCommande $ligneDeCommande): self
    {
        if ($this->ligneDeCommandes->removeElement($ligneDeCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneDeCommande->getFacture() === $this) {
                $ligneDeCommande->setFacture(null);
            }
        }

        return $this;
    }
}
