<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Frites;
use App\Entity\Boisson;
use App\Entity\Product;
use App\Entity\MenuBurger;
use App\Entity\MenuFrites;
use App\Entity\MenuTaille;
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
        'normalization_context' => ['groups' => ['Menu:read:all']],
        'denormalization_context' => ['groups' => ['Menu:write']],
      
    ],
],
 itemOperations:         ["get"=>[  
   
    'normalization_context' => ['groups' => ['Menu:read:id']],
    
  
],
 "put","delete"],
    )]

class Menu  extends Product 
{

    #[Groups(['Menu:read:id'])]
    protected $id;
    #[Groups(['Menu:read:id'])]
    protected $nom;
    #[Groups(['Menu:read:id'])]
    protected $image;
    #[Groups(['catalogue:read','Menu:read:simple','Menu:write','Menu:read:all','Menu:read:id'])]
    protected $prix;
    #[Groups(['catalogue:read','Menu:read:simple','Menu:write','Menu:read:all','Menu:read:id'])]
    protected $qtStock;

    #[Groups(['catalogue:read','Menu:read:simple','Menu:write','Menu:read:all','Menu:read:id'])]
    protected $libelle;
    
    
    // #[ORM\Column(type: 'string', length: 255, nullable: true)]
    //  #[Groups(['catalogue:read','Menu:read:simple','Menu:write','Menu:read:all','Menu:read:id'])]
    // private $libelle;
  
     #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    // #[Groups(['Menu:read:simple'])]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTaille::class,cascade:['persist'])]
    #[Groups(['Menu:write','Menu:read:all','Menu:read:simple','Menu:read:id'])]
    #[ApiSubresource()]
    // #[SerializedName('Boissons')]
    private $menutailles;

    #[Groups(['catalogue:read','Menu:read:simple','Menu:write','Menu:read:all','Menu:read:id'])]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuFrites::class,cascade:['persist'])]
    private Collection $menuFrites;

    #[Groups(['catalogue:read','Menu:read:simple','Menu:write','Menu:read:all','Menu:read:id'])]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuBurger::class,cascade:['persist'])]
    private Collection $menuBurgers;

    public function __construct()
    {
        parent::__construct();
     
        $this->menutailles = new ArrayCollection();
        $this->menuFrites  = new ArrayCollection();
        $this->menuBurgers = new ArrayCollection();
        
    }


    // public function getLibelle(): ?string
    // {
    //     return $this->libelle;
    // }

    // public function setLibelle(?string $libelle): self
    // {
    //     $this->libelle = $libelle;

    //     return $this;
    // }


    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

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

    /**
     * @return Collection<int, MenuFrites>
     */
    public function getMenuFrites(): Collection
    {
        return $this->menuFrites;
    }

    public function addMenuFrite(MenuFrites $menuFrite): self
    {
        if (!$this->menuFrites->contains($menuFrite)) {
            $this->menuFrites->add($menuFrite);
            $menuFrite->setMenu($this);
        }

        return $this;
    }

    public function removeMenuFrite(MenuFrites $menuFrite): self
    {
        if ($this->menuFrites->removeElement($menuFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuFrite->getMenu() === $this) {
                $menuFrite->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuBurger>
     */
    public function getMenuBurgers(): Collection
    {
        return $this->menuBurgers;
    }

    public function addMenuBurger(MenuBurger $menuBurger): self
    {
        if (!$this->menuBurgers->contains($menuBurger)) {
            $this->menuBurgers->add($menuBurger);
            $menuBurger->setMenu($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurger $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getMenu() === $this) {
                $menuBurger->setMenu(null);
            }
        }

        return $this;
    }


  

}