<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Frites;
use App\Entity\Boisson;
use App\Entity\Product;
use App\Entity\Gestionnaire;
use App\Entity\QuantiteFrite;
use App\Entity\QuantiteBurger;
use App\Entity\QuantiteBoisson;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Cascade;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    collectionOperations:   [
    "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['Menu:read:simple']],
    ],
 
    "post"=>[  
        'method' => 'post',
        'denormalization_context' => ['groups' => ['Menu:write']],
      
]
],
 itemOperations:         ["put","get","delete"],
    )]

class Menu  extends Product 
{
    #[Groups(['Menu:write'])]
    protected $image;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['Menu:read:simple','Menu:write'])]
    private $libelle;


     #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    // #[Groups(['Menu:read:simple'])]
    private $gestionnaire;

    // #[ORM\Column(type: 'float', nullable: true)]
    // #[Groups(['Menu:write'])]
    // private $prixMenu;

 

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuFrites::class,cascade:['persist'])]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('Frites')]
    private $qtfrites;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuBurger::class,cascade:['persist'])]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('Burgers')]
    private $qtburgers;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTaille::class,cascade:['persist'])]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('Boissons')]
    private $menutailles;

  

    public function __construct()
    {
        parent::__construct();
     
        $this->qtfrites = new ArrayCollection();
        $this->qtburgers = new ArrayCollection();
        $this->menutailles = new ArrayCollection(); 
    }


    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

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


  
    // #[Groups(['Menu:read:simple'])]
    // public function getPrixMenu(): void
    // {
        // $tb = new MenuBurger();
        
        // $tb->totalBurger();
        // dd($this->totalBoisson());
        // $add = $this->menutailles;
        // foreach ($add as $value){
        //     $this->$value.getPrix();
        //     $this->$value.getQtburgers();
        //     dd($this->$value);
        //  }
        // foreach ()
        // $reduction = 0.05;
        // $prixFinal=$this->totalBoisson()+$this->totalBurger()+$this->totalFrite() * $reduction;
        
        // $this->setPrix($prixFinal);
        
    // }

    // public function setPrixMenu(?float $prixMenu): self
    // {
    //     $this->prixMenu= $prixMenu ;

    //     return $this;
    // }

    // public function totalBurger(){
        // return array_reduce($this->qtburgers->toArray(),
        //  function($totalBurger,$qtburgers){
             
        //     return $totalBurger+$qtburgers->getPrix();
        // },0);


    // }

    //  public function totalBoisson(){
    //      return array_reduce($this->qtBoissons->toArray(),
    //       function($totalBoisson ,$qtBoissons){
    //          return $totalBoisson+$qtBoissons->getPrix();
    //      },0);
    //  }
    
    // public function totalFrite(){
    //     return array_reduce($this->qtfrites->toArray(),
    //      function($totalFrite ,$qtfrites){
    //         return $totalFrite+$qtfrites->getPrix()*get;
    //     },0);
    // }

   
    /**
     * @return Collection<int, MenuFrites>
     */
    public function getQtfrites(): Collection
    {
        return $this->qtfrites;
    }

    public function addQtfrite(MenuFrites $qtfrite): self
    {
        if (!$this->qtfrites->contains($qtfrite)) {
            $this->qtfrites[] = $qtfrite;
            $qtfrite->setMenu($this);
        }

        return $this;
    }

    public function removeQtfrite(MenuFrites $qtfrite): self
    {
        if ($this->qtfrites->removeElement($qtfrite)) {
            // set the owning side to null (unless already changed)
            if ($qtfrite->getMenu() === $this) {
                $qtfrite->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuBurger>
     */
    public function getQtburgers(): Collection
    {
        return $this->qtburgers;
    }

    public function addQtburger(MenuBurger $qtburger): self
    {
        if (!$this->qtburgers->contains($qtburger)) {
            $this->qtburgers[] = $qtburger;
            $qtburger->setMenu($this);
        }

        return $this;
    }

    public function removeQtburger(MenuBurger $qtburger): self
    {
        if ($this->qtburgers->removeElement($qtburger)) {
            // set the owning side to null (unless already changed)
            if ($qtburger->getMenu() === $this) {
                $qtburger->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuTaille>
     */
    public function getMenutailles(): Collection
    {
        return $this->menutailles;
    }

    public function addMenutaille(MenuTaille $menutaille): self
    {
        if (!$this->menutailles->contains($menutaille)) {
            $this->menutailles[] = $menutaille;
            $menutaille->setMenu($this);
        }

        return $this;
    }

    public function removeMenutaille(MenuTaille $menutaille): self
    {
        if ($this->menutailles->removeElement($menutaille)) {
            // set the owning side to null (unless already changed)
            if ($menutaille->getMenu() === $this) {
                $menutaille->setMenu(null);
            }
        }

        return $this;
    }

}