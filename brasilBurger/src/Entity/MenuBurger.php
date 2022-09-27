<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\MenuBurger;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\MenuBurgerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: MenuBurgerRepository::class)]
#[ApiResource]
class MenuBurger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    // #[Groups(['catalogue:read'])]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['catalogue:read','Menu:write','Menu:read:simple','Menu:read:all','Menu:read:id'])]
    // #[SerializedName('QuantiteBurgers')]
    private $qtburgers;

    
    // #[Groups(['catalogue:read'])]
    #[ORM\ManyToOne(targetEntity:Menu::class,inversedBy: 'menuBurgers')]
    private ?Menu $menu = null;
    
    #[Groups(['Menu:write','Menu:read:simple','Menu:read:all','Menu:read:id'])]
    #[ORM\ManyToOne(targetEntity:Burger::class,inversedBy: 'menuBurgers')]
    private ?Burger $burger = null;
 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQtburgers(): ?int
    {
        return $this->qtburgers;
    }

    public function setQtburgers(?int $qtburgers): self
    {
        $this->qtburgers = $qtburgers;

        return $this;
    }

  

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }

    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

   
}
