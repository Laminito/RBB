<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LigneDeCommandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LigneDeCommandeRepository::class)]
#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['LDC:read:simple']],
         ],
       
         "post"=>[
             'method' => 'post',
             'normalization_context' => ['groups' => ['LDC:read:all']],
              'denormalization_context' => ['groups' => ['Burger:write']],
         ],
        
     ],
     itemOperations:         [
         "delete",
       
         "put",
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['LDC:read:all']],
         ],  
     ],
    )]
class LigneDeCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    // #[Groups(['Commande:read:simple','LDC:read:all','LDC:read:simple'])]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['Commande:write'])]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'lignedecommandes')]
    #[Groups(['Commande:read:simple','Commande:read:all','LDC:read:all','LDC:read:simple','Commande:write'])]
    private $product;

    #[ORM\ManyToOne(targetEntity: Facture::class, inversedBy: 'lignedecommandes')]
    // #[Groups(['Commande:read:simple','Commande:read:all','LDC:read:all','LDC:read:simple'])]
    private $facture;

    #[ORM\OneToMany(mappedBy: 'lignesDeCommandes', targetEntity: Commande::class)]
    private $commandes;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prixLDC;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
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

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setLignesDeCommandes($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLignesDeCommandes() === $this) {
                $commande->setLignesDeCommandes(null);
            }
        }

        return $this;
    }

    public function getPrixLDC(): ?float
    {
        return $this->prixLDC;
    }

    public function setPrixLDC(?float $prixLDC): self
    {
        $this->prixLDC = $prixLDC;

        return $this;
    }
}
