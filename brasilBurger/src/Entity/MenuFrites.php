<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Frites;
use App\Entity\MenuFrites;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\MenuFritesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: MenuFritesRepository::class)]
#[ApiResource]
class MenuFrites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['Menu:write','Menu:read:simple','Menu:read:all','Frites:write','Menu:read:id'])]
    // #[SerializedName('QuantiteFrites')]
    private $qtfrites;

    
    // #[Groups(['catalogue:read'])]
    #[ORM\ManyToOne(targetEntity:Menu::class,inversedBy: 'menuFrites',cascade:['persist'])]
    private ?Menu $menu = null;

    #[ORM\ManyToOne(targetEntity:Frites::class, inversedBy: 'menuFrites',cascade:['persist'])]
    #[Groups(['catalogue:read','Menu:write','Menu:read:simple','Menu:read:all','Menu:read:id'])]
    private ?Frites $frite = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQtfrites(): ?int
    {
        return $this->qtfrites;
    }

    public function setQtfrites(?int $qtfrites): self
    {
        $this->qtfrites = $qtfrites;

        return $this;
    }

 

    public function getFrite(): ?Frites
    {
        return $this->frite;
    }

    public function setFrite(?Frites $frite): self
    {
        $this->frite = $frite;

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
