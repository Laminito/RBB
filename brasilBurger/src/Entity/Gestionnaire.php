<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Burger;
use App\Entity\Livreur;
use App\Entity\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GestionnaireRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GestionnaireRepository::class)]
#[ApiResource(
      collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Gestionnaire:read:simple']],
             'security'=>"is_granted('ROLE_GESTIONNAIRE')",
             'security_messages' => "Vous n'avez pas acces à cette ressource"
         ],
         "post"=>[  
              'method' => 'post',
              'path'   =>"/register/gestionnaire",
              'security'=>"is_granted('ROLE_GESTIONNAIRE')",
              'security_messages' => "Vous n'avez pas acces à cette ressource",
     ]
  ],
      itemOperations:         [
          "get"=>[
              'method' => 'get',
              'status' => Response::HTTP_OK,
              'normalization_context' => ['groups' => ['Gestionnaire:read:All']],
              'security'=>"is_granted('ROLE_GESTIONNAIRE')",
              'security_messages' => "Vous n'avez pas acces à cette ressource" 
          ],
          "put"=>[
              'method' => 'put',
              'security'=>"is_granted('ROLE_GESTIONNAIRE')",
              'security_messages' => "Vous n'avez pas acces à cette ressource" 
          ],
        ],
 )]
class Gestionnaire extends User
{
   
    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Burger::class)]
    #[ApiSubresource]
    // #[Groups(['Burger:write'])]
    private $burgers;

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Livreur::class)]
    #[ApiSubresource]
    private $livreurs;

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Product::class)]
    #[ApiSubresource]
    private $products;

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Menu::class)]
    #[ApiSubresource]
    private $menus;

    public function __construct()
    {
        $this->burgers = new ArrayCollection();
        $this->roles=['ROLE_GESTIONNAIRE'];
        $this->livreurs = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->menus = new ArrayCollection();
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
            $burger->setGestionnaire($this);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        if ($this->burgers->removeElement($burger)) {
            // set the owning side to null (unless already changed)
            if ($burger->getGestionnaire() === $this) {
                $burger->setGestionnaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livreur>
     */
    public function getLivreurs(): Collection
    {
        return $this->livreurs;
    }

    public function addLivreur(Livreur $livreur): self
    {
        if (!$this->livreurs->contains($livreur)) {
            $this->livreurs[] = $livreur;
            $livreur->setGestionnaire($this);
        }

        return $this;
    }

    public function removeLivreur(Livreur $livreur): self
    {
        if ($this->livreurs->removeElement($livreur)) {
            // set the owning side to null (unless already changed)
            if ($livreur->getGestionnaire() === $this) {
                $livreur->setGestionnaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setGestionnaire($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getGestionnaire() === $this) {
                $product->setGestionnaire(null);
            }
        }

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
            $menu->setGestionnaire($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getGestionnaire() === $this) {
                $menu->setGestionnaire(null);
            }
        }

        return $this;
    }
}
