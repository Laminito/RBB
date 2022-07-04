<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends Personne
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $login;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $password;

    #[ORM\Column(type: 'boolean', nullable: true)]
    protected $etatUser;


    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function isEtatUser(): ?bool
    {
        return $this->etatUser;
    }

    public function setEtatUser(?bool $etatUser): self
    {
        $this->etatUser = $etatUser;

        return $this;
    }
}
