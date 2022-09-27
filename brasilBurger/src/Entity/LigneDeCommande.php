<?php

namespace App\Entity;

use App\Entity\Commande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LigneDeCommandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LigneDeCommandeRepository::class)]
#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['ldc:read:simple']],
         ],
       
         "post"=>[
             'method' => 'post',
             'normalization_context' => ['groups' => ['ldc:read:all']],
              'denormalization_context' => ['groups' => ['ldc:write']],
         ],
        
     ],
     itemOperations:         [
         "delete",
       
         "put",
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['ldc:read:id']],
         ],  
     ],
    )]
class LigneDeCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['ldc:read:all','ldc:read:simple'])]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['Commande:write','Commande:read:all','ldc:write','ldc:read:all','ldc:read:simple','Commande:read:simple'])]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'lignedecommandes',cascade:['persist'])]
    #[Groups(['Commande:read:simple','Commande:read:all','Commande:write','ldc:write','ldc:read:all','ldc:read:simple'])]
    private $product;

    #[ORM\ManyToOne(targetEntity: Facture::class, inversedBy: 'lignedecommandes')]
    // #[Groups(['Commande:read:simple','Commande:read:all','ldc:read:all','LDC:read:simple'])]
    private $facture;
    // #[Groups(['Commande:read:simple','Commande:read:all','Commande:write','ldc:write','ldc:read:all','ldc:read:simple'])]

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'lignesdecommandes',cascade:["persist"])]
    private $commande;

    public function __construct(){
        
    }
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
