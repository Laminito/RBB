<?php

namespace App\Entity;

use App\Entity\Zone;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Livraison;
use App\Entity\EtatCommande;
use App\Entity\Gestionnaire;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateCommande;

    #[ORM\Column(type: 'float', nullable: true)]
    private $montantCommande;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $etatPayement;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $typeRecuperation;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    private $client;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commandes')]
    private $zone;

    #[ORM\ManyToOne(targetEntity: EtatCommande::class, inversedBy: 'commandes')]
    private $etatCommande;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    private $livraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(?\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getMontantCommande(): ?float
    {
        return $this->montantCommande;
    }

    public function setMontantCommande(?float $montantCommande): self
    {
        $this->montantCommande = $montantCommande;

        return $this;
    }

    public function isEtatPayement(): ?bool
    {
        return $this->etatPayement;
    }

    public function setEtatPayement(?bool $etatPayement): self
    {
        $this->etatPayement = $etatPayement;

        return $this;
    }

    public function getTypeRecuperation(): ?string
    {
        return $this->typeRecuperation;
    }

    public function setTypeRecuperation(?string $typeRecuperation): self
    {
        $this->typeRecuperation = $typeRecuperation;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getEtatCommande(): ?EtatCommande
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(?EtatCommande $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }
}
