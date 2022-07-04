<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Boisson;
use App\Entity\Produit;
use App\Entity\Gestionnaire;
use App\Entity\PortionFrite;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu extends Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $libelleMenu;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: PortionFrite::class)]
    private $portionFrites;

    #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'menus')]
    private $boissons;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    private $gestionnaire;

    #[ORM\ManyToMany(targetEntity: Burger::class, inversedBy: 'menus')]
    private $burgers;

    public function __construct()
    {
        $this->portionFrites = new ArrayCollection();
        $this->boissons = new ArrayCollection();
        $this->burgers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleMenu(): ?string
    {
        return $this->libelleMenu;
    }

    public function setLibelleMenu(?string $libelleMenu): self
    {
        $this->libelleMenu = $libelleMenu;

        return $this;
    }

    /**
     * @return Collection<int, PortionFrite>
     */
    public function getPortionFrites(): Collection
    {
        return $this->portionFrites;
    }

    public function addPortionFrite(PortionFrite $portionFrite): self
    {
        if (!$this->portionFrites->contains($portionFrite)) {
            $this->portionFrites[] = $portionFrite;
            $portionFrite->setMenu($this);
        }

        return $this;
    }

    public function removePortionFrite(PortionFrite $portionFrite): self
    {
        if ($this->portionFrites->removeElement($portionFrite)) {
            // set the owning side to null (unless already changed)
            if ($portionFrite->getMenu() === $this) {
                $portionFrite->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        $this->boissons->removeElement($boisson);

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

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        $this->burgers->removeElement($burger);

        return $this;
    }
}
