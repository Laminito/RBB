<?php

namespace App\Entity;

use App\Entity\Gestionnaire;
use App\Entity\LigneDeCommande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
    #[ORM\InheritanceType("JOINED")]
                  #[ORM\DiscriminatorColumn(name:"type", type:"string")]
                  #[ORM\DiscriminatorMap([
                      "burger" => "Burger",
                      "menu" => "Menu",
                      "frites" => "Frites",
                      "boisson" => "Boisson",
                  ])]

#[ApiResource(
      collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Product:read:simple']],
              'denormalizationContext'=> ['groups' => ['Product:write']]

         ],
     ],
       itemOperations:         [],

 )]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    
    #[Groups(['Menu:write'])]
    protected $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['Burger:write','LDC:read:simple','Burger:read:simple','Product:read:simple','Burger:read:all','Boisson:read:simple','Frites:read:simple','Menu:read:simple'])]
    // #[Assert\NotBlank(message:"Le nom est Obligatoire")]
    protected $nom;

    // #[ORM\Column(type: 'object', nullable: true)]
    // #[Groups(['Burger:write','LDC:read:simple','Burger:read:simple','Product:read:simple','Burger:read:all','Boisson:read:simple','Frites:read:simple'])]
    // protected $image;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['Burger:write','LDC:read:simple','Burger:read:simple','Product:read:simple','Burger:read:all','Boisson:read:simple','Frites:read:simple'])]
    // #[Assert\NotBlank(message:"Le prix est Obligatoire")]
    protected $prix;

    #[ORM\Column(type: 'boolean', nullable: true)]
    // #[Groups(['Burger:read:all','LDC:read:simple'])]
    private $etat=true;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'products')]
    #[ApiSubresource]
    // #[Groups(['Burger:read:simple','Burger:read:all', 'Burger:write'])]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: LigneDeCommande::class)]
    // #[Groups(['Burger:read:simple','Burger:read:all'])]
    #[ApiSubresource]
    private $lignedecommandes;

    #[ORM\Column(type: 'blob', nullable: true)]
    protected $image;

    
    #[Groups(['Burger:write','LDC:read:simple','Burger:read:simple','Product:read:simple','Burger:read:all','Boisson:read:simple','Frites:read:simple'])]
    #[SerializedName('image')]
    protected $imageTaupe;

    public function __construct()
    {
        $this->lignedecommandes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

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

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(?bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection<int, LigneDeCommande>
     */
    public function getLignedecommandes(): Collection
    {
        return $this->lignedecommandes;
    }

    public function addLignedecommande(LigneDeCommande $lignedecommande): self
    {
        if (!$this->lignedecommandes->contains($lignedecommande)) {
            $this->lignedecommandes[] = $lignedecommande;
            $lignedecommande->setProduct($this);
        }

        return $this;
    }

    public function removeLignedecommande(LigneDeCommande $lignedecommande): self
    {
        if ($this->lignedecommandes->removeElement($lignedecommande)) {
            // set the owning side to null (unless already changed)
            if ($lignedecommande->getProduct() === $this) {
                $lignedecommande->setProduct(null);
            }
        }

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
 
 

    /**
     * Get the value of imageTaupe
     */ 
    public function getImageTaupe()
    {
        return $this->imageTaupe;
    }

    /**
     * Set the value of imageTaupe
     *
     * @return  self
     */ 
    public function setImageTaupe($imageTaupe)
    {
        $this->imageTaupe = $imageTaupe;

        return $this;
    }
}
