<?php

namespace App\Entity;

use App\Entity\Taille;
use App\Entity\Boisson;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonTailleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;

#[ORM\Entity(repositoryClass: BoissonTailleRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['BoissonTaille:read:simple']],
        ],
        "post"
    ],
    itemOperations:         ["put","get","delete"],
    )]
class BoissonTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'boissonTailles')]
    private $taille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }
}
