<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Commande:read:simple']],
        ],
       
        "post"=>[
            'method' => 'post',
            'normalization_context' => ['groups' => ['Commande:read:all']],
            // 'denormalization_context' => ['groups' => ['Burger:write']],
        ],
        
    ],
    itemOperations:         [
        "delete",
       
        "put",
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Commande:read:all']],
        ],  
    ],
    )]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['Commande:read:simple'])]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['Commande:read:simple','Commande:read:all'])]
    private $date;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['Commande:read:simple','Commande:read:all'])]
    private $prix;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['Commande:read:simple','Commande:read:all'])]
    private $etat=true;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['Commande:read:simple','Commande:read:all'])]
    private $recuperation;

    #[ORM\OneToOne(targetEntity: Facture::class, cascade: ['persist', 'remove'])]
    #[Groups(['Commande:read:simple','Commande:read:all'])]
    private $facture;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'zones')]
    #[Groups(['Commande:read:simple','Commande:read:all'])]
    private $clients;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commandes')]
    private $zones;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    private $livraisons;

    #[ORM\ManyToOne(targetEntity: EtatCommande::class, inversedBy: 'commandes')]
    private $etatcommande;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(?bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getRecuperation(): ?string
    {
        return $this->recuperation;
    }

    public function setRecuperation(?string $recuperation): self
    {
        $this->recuperation = $recuperation;

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

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getZones(): ?Zone
    {
        return $this->zones;
    }

    public function setZones(?Zone $zones): self
    {
        $this->zones = $zones;

        return $this;
    }

    public function getLivraisons(): ?Livraison
    {
        return $this->livraisons;
    }

    public function setLivraisons(?Livraison $livraisons): self
    {
        $this->livraisons = $livraisons;

        return $this;
    }

    public function getEtatcommande(): ?EtatCommande
    {
        return $this->etatcommande;
    }

    public function setEtatcommande(?EtatCommande $etatcommande): self
    {
        $this->etatcommande = $etatcommande;

        return $this;
    }
   
}
