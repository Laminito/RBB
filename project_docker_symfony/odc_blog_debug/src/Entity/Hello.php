<?php

namespace App\Entity;

use App\Repository\HelloRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HelloRepository::class)
 */
class Hello
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bonjour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonjour(): ?string
    {
        return $this->bonjour;
    }

    public function setBonjour(string $bonjour): self
    {
        $this->bonjour = $bonjour;

        return $this;
    }
}
