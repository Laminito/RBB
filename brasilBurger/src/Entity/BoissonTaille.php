<?php

namespace App\Entity;

use App\Entity\Taille;
use App\Entity\Boisson;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonTailleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

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
    // #[Groups(['Taille:write'])]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['Taille:read:simple','Taille:write'])]
    // #[Groups(['Menu:write'])]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'boissonTailles')]
    // #[Groups(['Menu:write'])]
    // #[Groups(['Taille:read:simple','Taille:write'])]
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
