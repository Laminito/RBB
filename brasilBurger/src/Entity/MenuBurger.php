<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
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
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('QuantiteBurgers')]
    private $qtburgers;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'qtburgers')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'qtburgers')]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('Burgers')]
    private $burger;

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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

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
//  public function totalBurger(){
      # code...
     
        // return array_reduce($this->burger->toArray(),
        //  function($totalBurger,$burger){
        //     return $totalBurger+$burger->getPrix()*$burgers->getQtburgers();
        // },0);
    
    // }  
}
