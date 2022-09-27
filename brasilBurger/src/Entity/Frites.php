<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Frites;
use App\Entity\Product;
use App\Entity\Products;
use App\Entity\Complement;
use App\Entity\MenuFrites;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\FritesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;


#[ORM\Entity(repositoryClass: FritesRepository::class)]
#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Frites:read:simple']],
         ],
 
         "post"=>[  
             'method' => 'post',
             'normalization_context'   => ['groups' => ['Frites:read:all']],
             'denormalization_context' => ['groups' => ['Frites:write']],
           
         ],
     ],
     itemOperations:         ["put","get","delete"],
    )]
class Frites extends Product
{
    #[Groups(['Menu:read:id'])]
    protected $id;
    #[Groups(['Menu:read:id'])]
    protected $nom;
    #[Groups(['Menu:read:id'])]
    protected $image;
    #[Groups(['Menu:read:id'])]
    protected $prix;

    #[Groups(['catalogue:read'])]
    #[ORM\OneToMany(mappedBy: 'frite', targetEntity: MenuFrites::class)]
    private Collection $menuFrites;

    
    public function __construct()
    {
        parent::__construct();
        $this->menuFrites = new ArrayCollection();
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
            $menuFrite->setFrite($this);
        }

        return $this;
    }

    public function removeMenuFrite(MenuFrites $menuFrite): self
    {
        if ($this->menuFrites->removeElement($menuFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuFrite->getFrite() === $this) {
                $menuFrite->setFrite(null);
            }
        }

        return $this;
    }
}
