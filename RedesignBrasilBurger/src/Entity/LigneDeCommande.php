<?php

namespace App\Entity;

use App\Entity\Facture;
use App\Entity\Produit;
use Doctrine\ORM\Mapping\Id;
use App\Entity\LigneDeCommande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\GeneratedValue;
use App\Repository\LigneDeCommandeRepository;

#[ORM\Entity(repositoryClass: LigneDeCommandeRepository::class)]
class LigneDeCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantiteProduit;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'ligneDeCommandes')]
    private $produit;

    #[ORM\ManyToOne(targetEntity: Facture::class, inversedBy: 'ligneDeCommandes')]
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteProduit(): ?int
    {
        return $this->quantiteProduit;
    }

    public function setQuantiteProduit(?int $quantiteProduit): self
    {
        $this->quantiteProduit = $quantiteProduit;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }
}
