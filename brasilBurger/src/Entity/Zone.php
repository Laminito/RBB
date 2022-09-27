<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ZoneRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ZoneRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Zone:read:simple']],
        ],
        "post"=>[
           'method' => 'post',
           'normalization_context' => ['groups' => ['Zone:read:all']],
           'denormalization_context' => ['groups' => ['Zone:write']]
        ],
    ],
    itemOperations:         ["put","get","delete"],
   )]
class Zone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['Quartier:write','Zone:read:all','Zone:read:simple','Livraison:write'])]
    private $id;
    #[Groups(['Zone:write','Zone:read:all','Zone:read:simple'])]
    #[ORM\Column(type: 'float', nullable: true)]
    private $prix;

    #[Groups(['Zone:read:all','Zone:read:simple','Zone:write'])]
     #[ORM\OneToMany(mappedBy: 'zone', targetEntity: Quartier::class)]
    private $quartier;

    #[Groups(['Zone:write','Zone:read:all','Zone:read:simple'])]
    #[ORM\Column(length: 255, nullable: true)]
    private $nom ;

    public function __construct()
    {
        $this->quartier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Quartier>
     */
    public function getQuartier(): Collection
    {
        return $this->quartier;
    }

    public function addQuartier(Quartier $quartier): self
    {
        if (!$this->quartier->contains($quartier)) {
            $this->quartier[] = $quartier;
            $quartier->setZone($this);
        }

        return $this;
    }

    public function removeQuartier(Quartier $quartier): self
    {
        if ($this->quartier->removeElement($quartier)) {
            // set the owning side to null (unless already changed)
            if ($quartier->getZone() === $this) {
                $quartier->setZone(null);
            }
        }

        return $this;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
