<?php

namespace App\Entity;

use App\Entity\BoissonTaille;
use Doctrine\ORM\Mapping as ORM;
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
        "post"
    ],
    itemOperations:         ["put","get","delete"],
    )]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['Taille:read:simple'])]
    private $id;

    #[ORM\Column(type: 'string',nullable: true, length: 255)]
    private $model;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: BoissonTaille::class)]
    #[ApiSubresource]
    private $boissonTailles;

    public function __construct()
    {
        $this->boissonTailles = new ArrayCollection();
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
    
}
