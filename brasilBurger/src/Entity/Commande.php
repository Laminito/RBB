<?php

namespace App\Entity;

use App\Entity\Zone;
use App\Entity\Client;
use App\Entity\Facture;
use App\Entity\Commande;
use App\Entity\Livraison;
use App\Entity\EtatCommande;
use App\Entity\LigneDeCommande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

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
             'denormalization_context' => ['groups' => ['Commande:write']],
         ],
        
     ],
     itemOperations:         [
         "delete",
       
         "put",
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Commande:read:id']],
         ],  
     ],
    )]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['Commande:read:simple','Livraison:write','Commande:read:id'])]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['Commande:read:simple','Commande:read:all','Commande:read:id'])]
    private $date;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['Commande:read:simple','Commande:write','Commande:read:all','Commande:read:id'])]
    private $prix;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['Commande:read:simple','Commande:read:all','Commande:read:id'])]
    private $etat=true;

    #[ORM\Column(type: 'boolean',  nullable: true)]
    #[Groups(['Commande:read:simple','Commande:read:all','Commande:read:id'])]
    private $recuperation=true;

    #[ORM\OneToOne(targetEntity: Facture::class, cascade: ['persist', 'remove'])]
    // #[Groups(['Commande:read:simple','Commande:read:all'])]
    private $facture;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'zones')]
    // #[Groups(['Commande:write','Commande:read:simple','Commande:read:all','Commande:read:id'])]
    private $clients;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    // #[Groups(['Commande:write','Commande:read:simple','Commande:read:all'])]
    private $livraisons;

  

    #[Groups(['Commande:read:simple','Commande:read:all','Commande:write'])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: LigneDeCommande::class,cascade:['persist'])]
    #[SerializedName("Produits")]
    private $lignesdecommandes;

    #[Groups(['Commande:read:simple','Commande:read:all'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etatCommande = null;
    
    #[Groups(['Commande:read:simple','Commande:read:all'])]
    #[ORM\Column(length: 255)]
    private ?string $code = null;

    public function __construct()
    {
        $this->code =$FourDigitRandomNumber = rand(1231,7879);
        $this->etatCommande="En cours";
        $this->date=new \DateTime();
        $this->lignesdecommandes = new ArrayCollection();
    }



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

    public function getLivraisons(): ?Livraison
    {
        return $this->livraisons;
    }

    public function setLivraisons(?Livraison $livraisons): self
    {
        $this->livraisons = $livraisons;

        return $this;
    }

    // public function getEtatcommande(): ?EtatCommande
    // {
    //     return $this->etatcommande;
    // }

    // public function setEtatcommande(?EtatCommande $etatcommande): self
    // {
    //     $this->etatcommande = $etatcommande;

    //     return $this;
    // }

    /**
     * @return Collection<int, LigneDeCommande>
     */
    public function getLignesdecommandes(): Collection
    {
        return $this->lignesdecommandes;
    }

    public function addLignesdecommande(LigneDeCommande $lignesdecommande): self
    {
        if (!$this->lignesdecommandes->contains($lignesdecommande)) {
            $this->lignesdecommandes[] = $lignesdecommande;
            $lignesdecommande->setCommande($this);
        }

        return $this;
    }

    public function removeLignesdecommande(LigneDeCommande $lignesdecommande): self
    {
        if ($this->lignesdecommandes->removeElement($lignesdecommande)) {
            // set the owning side to null (unless already changed)
            if ($lignesdecommande->getCommande() === $this) {
                $lignesdecommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getEtatCommande(): ?string
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(?string $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
   
}
