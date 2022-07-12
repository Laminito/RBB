<?php

namespace App\Entity;

use App\Entity\Frites;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\MenuFritesRepository;
use ApiPlatform\Core\Annotation\ApiResource;
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
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('QuantiteFrites')]
    private $qtfrites;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'qtfrites')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Frites::class, inversedBy: 'qtfrites')]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('PortionFrites')]
    private $frites;

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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getFrites(): ?Frites
    {
        return $this->frites;
    }

    public function setFrites(?Frites $frites): self
    {
        $this->frites = $frites;

        return $this;
    }
}
