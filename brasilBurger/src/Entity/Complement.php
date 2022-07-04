<?php

namespace App\Entity;

use App\Entity\Product;
use App\Entity\Complement;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ComplementRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: ComplementRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type:"string")]
#[ORM\DiscriminatorMap([
    // "frites" => "Frites",
    // "boisson" => "Boisson" ,
    "complement"=> "Complement"  
])]

// s
class Complement extends Product
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['Complement:read','Complement:write'])]
    protected $nature;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'complements')]
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }


    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(?string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addComplement($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeComplement($this);
        }

        return $this;
    }
}
