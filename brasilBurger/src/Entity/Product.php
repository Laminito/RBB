<?php

namespace App\Entity;

use App\Entity\Product;
use App\Entity\Gestionnaire;
use App\Entity\LigneDeCommande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping\GeneratedValue;
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
             'normalization_context' => ['groups' => ['Product:read:simple']]
            

         ],
     ],
       itemOperations:         [
           "get"=>[
               
           ]
       ],

 )]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['ldc:write','ldc:read:all','ldc:read:simple','catalogue:read','Boissontaille:write','Menu:write','Menu:read:simple','Menu:read:all','Burger:read:all','Burger:read:simple','Frites:read:all','Frites:read:simple','Boisson:read:all','Boisson:read:simple','Commande:read:simple','Commande:read:all','Commande:write'])]
    protected $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['catalogue:read','Product:read:simple','Menu:write','Menu:read:all','Menu:read:simple','Boisson:read:all','Boisson:read:simple','Boisson:write','Frites:read:all','Frites:read:simple','Frites:write','LDC:read:simple','Burger:write','Burger:read:simple','Burger:read:all'])]
    // #[Assert\NotBlank(message:"Le nom est Obligatoire")]
    protected $nom;


    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['catalogue:read','Product:read:simple','Menu:write','Menu:read:all','Menu:read:simple','Frites:write','Frites:read:simple','Frites:read:all','Burger:write','Burger:read:simple','Burger:write','LDC:read:simple'])]
    // #[Assert\NotBlank(message:"Le prix est Obligatoire")]
    protected $prix;

    #[ORM\Column(type: 'boolean', nullable: true)]
    // #[Groups(['Burger:read:all','LDC:read:simple'])]
    private $etat=true;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'products')]
    #[ApiSubresource]
    // #[Groups(['Burger:read:simple','Burger:read:all', 'Burger:write'])]
    private $gestionnaire;

    #[Groups(['Burger:read:simple','Burger:read:all'])]
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: LigneDeCommande::class,cascade:['persist'])]
    #[ApiSubresource]
    private $lignedecommandes;

    
    #[ORM\Column(type: 'blob', nullable: true)]
    #[Groups(['catalogue:read','Product:read:simple','Boisson:read:all','Boisson:read:simple','LDC:read:simple','Burger:read:simple','Burger:read:all','Menu:read:all','Menu:read:simple','Frites:read:all','Frites:read:simple'])]
    protected $image;

    
    #[Groups(['catalogue:read','Product:read:simple'    ,'Boisson:read:all','Boisson:read:simple','Menu:write','Burger:read:simple','Burger:read:all','Frites:read:all','Frites:read:simple','LDC:read:simple'])]
    // #[SerializedName('image')]
    protected $imageTaupe;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['catalogue:read','Product:read:simple','Frites:read:simple','Frites:read:all','Frites:write','Menu:read:simple','Menu:read:all','Menu:write','Boisson:write','Boisson:read:all','Boisson:read:simple','Burger:write','Burger:read:simple','Burger:read:all'])]
    private $qtStock;

    #[ORM\Column(type: 'string',length: 100, nullable: true)]
    // #[Groups(['Menu:write','Menu:read:simple','Menu:read:all','Boisson:read:simple','Boisson:read:all','Boisson:write','Burger:write','LDC:read:simple','Burger:read:simple','Burger:read:all','Frites:write','Frites:read:all','Frites:read:simple'])]
    #[Groups(['catalogue:read','Product:read:simple','Menu:write','Menu:read:simple','Menu:read:all','Boisson:read:simple','Boisson:read:all','Boisson:write','Burger:write','Burger:read:simple','Burger:read:all','Frites:write','Frites:read:all','Frites:read:simple','LDC:read:simple'])]
    private $my_type_is ;

    #[Groups(['catalogue:read','Product:read:simple','Boisson:write','Boisson:read:all','Boisson:read:simple','Menu:write','Menu:read:simple','Menu:read:all','Burger:write','Burger:rea    d:simple','Burger:read:all','Frites:write','Frites:read:all','Frites:read:simple','LDC:read:simple'     ])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelle = null;

    public function __construct()
    { 
        $this->lignedecommandes = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
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
        return is_resource($this->image)?utf8_encode(base64_encode(stream_get_contents($this->image))):$this->image;
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

    public function getQtStock(): ?int
    {
        return $this->qtStock;
    }

    public function setQtStock(?int $qtStock): self
    {
        $this->qtStock = $qtStock;

        return $this;
    }

    public function getMyTypeIs(): ?string
    {
        return $this->my_type_is;
    }

    public function setMyTypeIs(?string $my_type_is): self
    {
        $this->my_type_is = $my_type_is;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

   
}
