<?php

namespace App\Entity;

use App\Entity\Menu;
use BurgerController;
use App\Entity\Burger;
use App\Entity\Product;
use App\Entity\Products;
use App\Entity\MenuBurger;
use App\Entity\Gestionnaire;
use App\Entity\QuantiteBurger;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\DependencyInjection\Loader\Configurator\security;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
 collectionOperations:   [
                "get"=>[
                    'method' => 'get',
                    'status' => Response::HTTP_OK,
                    'normalization_context' => ['groups' => ['Burger:read:simple']],
                ],
                
                "post"=>[
                    'method' => 'post',
                    'normalization_context' => ['groups' => ['Burger:read:all']],
                    'denormalization_context' => ['groups' => ['Burger:write']]
                ]
                // "add" => [
                //     'method' => 'Post',
                //     "path"=>"/add",
                //     "controller"=>BurgerController::class,
                //     ]
            ],
itemOperations:         [
    "delete",
    "put",
    "put" => [
        "method" => "put",
        "security" => "is_granted('ROLE_GESTIONNAIRE')",
        "security_message" => "Vous n'êtes pas autorisé !",
        
    ],
    "get"=>[
        'method' => 'get',
        'status' => Response::HTTP_OK,
        'normalization_context' => ['groups' => ['Burger:read:all']],
    ],  
],
)]

class Burger extends Product
{
    #[Groups(['Menu:read:id'])]
    protected $id;
    #[Groups(['Menu:read:id'])]
    protected $nom;
    #[Groups(['Menu:read:id'])]
    protected $image;
    #[Groups(['Menu:read:id'])]
    protected $prix;
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'burgers')]
    private $gestionnaire;


    // #[Groups(['catalogue:read'])]
    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: MenuBurger::class)]
    private Collection $menuBurgers;

    public function __construct()
    {
        parent::__construct();
        $this->menuBurgers = new ArrayCollection();
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
            $menuBurger->setBurger($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurger $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getBurger() === $this) {
                $menuBurger->setBurger(null);
            }
        }

        return $this;
    }

  
    }

   



