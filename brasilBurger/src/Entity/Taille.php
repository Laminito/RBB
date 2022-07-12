<?php

namespace App\Entity;

use App\Entity\MenuTaille;
use App\Entity\BoissonTaille;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Taille:read:simple']],
        ],
        "post"=>[
            'method' => 'post',
            'denormalization_context' => ['groups' => ['Taille:write']],
        ],
    ],
    itemOperations:         ["put","get","delete"],
    )]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    // #[Groups(['Taille:write'])]

    // #[Groups(['Menu:write','Taille:write'])]
    private $id;

    #[ORM\Column(type: 'string',nullable: true, length: 255)]
    #[Groups(['Taille:read:simple','Taille:write'])]
    private $model;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: BoissonTaille::class)]
    #[ApiSubresource]
    #[Groups(['Taille:read:simple','Taille:write'])]
    private $boissonTailles;

    // #[Groups(['Taille:read:simple','Taille:write'])]
    // #[ORM\Column(type: 'float', nullable: true)]
    // private $prixtaille;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: MenuTaille::class)]
    private $menutailles;

    public function __construct()
    {
        $this->boissonTailles = new ArrayCollection();
        $this->menutailles = new ArrayCollection();
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection<int, BoissonTaille>
     */
    public function getBoissonTailles(): Collection
    {
        return $this->boissonTailles;
    }

    public function addBoissonTaille(BoissonTaille $boissonTaille): self
    {
        if (!$this->boissonTailles->contains($boissonTaille)) {
            $this->boissonTailles[] = $boissonTaille;
            $boissonTaille->setTaille($this);
        }

        return $this;
    }

    public function removeBoissonTaille(BoissonTaille $boissonTaille): self
    {
        if ($this->boissonTailles->removeElement($boissonTaille)) {
            // set the owning side to null (unless already changed)
            if ($boissonTaille->getTaille() === $this) {
                $boissonTaille->setTaille(null);
            }
        }

        return $this;
    }

    // public function getPrixtaille(): ?float
    // {
    //     return $this->prixtaille;
    // }

    // public function setPrixtaille(?float $prixtaille): self
    // {
    //     $this->prixtaille = $prixtaille;

    //     return $this;
    // }

    /**
     * @return Collection<int, MenuTaille>
     */
    public function getMenutailles(): Collection
    {
        return $this->menutailles;
    }

    public function addMenutaille(MenuTaille $menutaille): self
    {
        if (!$this->menutailles->contains($menutaille)) {
            $this->menutailles[] = $menutaille;
            $menutaille->setTaille($this);
        }

        return $this;
    }

    public function removeMenutaille(MenuTaille $menutaille): self
    {
        if ($this->menutailles->removeElement($menutaille)) {
            // set the owning side to null (unless already changed)
            if ($menutaille->getTaille() === $this) {
                $menutaille->setTaille(null);
            }
        }

        return $this;
    }
    
}
