<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Livraison:read:simple']],
        ],
      
        "post"=>[
            'method' => 'post',
            'normalization_context' => ['groups' => ['Livraison:read:simple']],
            'denormalization_context' => ['groups' => ['Livraison:write']],
        ],
       
    ],
    itemOperations:         [
        "delete",
      
        "put",
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Livraison:read:all']],
        ],  
    ],
   )]
class Livraison
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['Commande:write','Livraison:read:simple'])]
    private $id;

    #[ORM\Column(type: 'time', nullable: true)]
    #[Groups(['Livraison:write','Livraison:read:all','Livraison:read:simple'])]
    private $durer;

    #[ORM\OneToMany(mappedBy: 'livraisons', targetEntity: Commande::class)]
    #[Groups(['Livraison:write','Livraison:read:all','Livraison:read:simple'])]
    private $commandes;

    #[ORM\ManyToOne(targetEntity: Livreur::class, inversedBy: 'livraisons')]
    #[Groups(['Livraison:write','Livraison:read:all','Livraison:read:simple'])]
    private $livreurs;
    
    #[Groups(['Livraison:write','Livraison:read:all','Livraison:read:simple'])]
     #[ORM\ManyToOne(inversedBy: 'livraisons')]
     private ?Quartier $quartier = null;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->durer=new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDurer(): ?\DateTimeInterface
    {
        return $this->durer;
    }

    public function setDurer(?\DateTimeInterface $durer): self
    {
        $this->durer = $durer;

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
            $commande->setLivraisons($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivraisons() === $this) {
                $commande->setLivraisons(null);
            }
        }

        return $this;
    }

    public function getLivreurs(): ?Livreur
    {
        return $this->livreurs;
    }

    public function setLivreurs(?Livreur $livreurs): self
    {
        $this->livreurs = $livreurs;

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

}
