<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Product;
use App\Entity\Complement;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FritesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\SerializedName;


#[ORM\Entity(repositoryClass: FritesRepository::class)]
#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Frites:read:simple']],
         ],
         "post"
     ],
     itemOperations:         ["put","get","delete"],
    )]
class Frites extends Product
{
    #[ORM\OneToMany(mappedBy: 'frites', targetEntity: MenuFrites::class)]
    private $qtfrites;

    #[ORM\OneToMany(mappedBy: 'frites', targetEntity: QuantiteFrite::class)]

    public function __construct()
    {
        parent::__construct();
        $this->qtfrites = new ArrayCollection();
       
    }

    /**
     * @return Collection<int, MenuFrites>
     */
    public function getQtfrites(): Collection
    {
        return $this->qtfrites;
    }

    public function addQtfrite(MenuFrites $qtfrite): self
    {
        if (!$this->qtfrites->contains($qtfrite)) {
            $this->qtfrites[] = $qtfrite;
            $qtfrite->setFrites($this);
        }

        return $this;
    }

    public function removeQtfrite(MenuFrites $qtfrite): self
    {
        if ($this->qtfrites->removeElement($qtfrite)) {
            // set the owning side to null (unless already changed)
            if ($qtfrite->getFrites() === $this) {
                $qtfrite->setFrites(null);
            }
        }

        return $this;
    }

}
