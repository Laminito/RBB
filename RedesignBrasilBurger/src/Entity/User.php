<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"role", type:"string")]
#[ORM\DiscriminatorMap([
    "gestionnaire"  => "Gestionnaire",
    "client"        => "Client",
    "livreur"       => "Livreur"

])]

#[ApiResource()]
abstract class User extends Personne implements UserInterface, PasswordAuthenticatedUserInterface
{
   

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    protected $email;

    #[ORM\Column(type: 'json')]
    protected $roles = [];

    #[ORM\Column(type: 'string')]
    protected $password;

    #[ORM\Column(type: 'boolean', nullable: true)]
    protected $etatuser;

    #[ORM\Column(type: 'boolean')]

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_VISITEUR';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isEtatuser(): ?bool
    {
        return $this->etatuser;
    }

    public function setEtatuser(?bool $etatuser): self
    {
        $this->etatuser = $etatuser;

        return $this;
    }

}
