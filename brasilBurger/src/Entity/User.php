<?php

namespace App\Entity;

use App\Entity\Burger;
use App\Entity\Personne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\UserRepository;
use App\Controller\MailerController;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]                                  
                                             
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"role", type:"string")]
#[ORM\DiscriminatorMap([
    "gestionnaire" => "Gestionnaire",
    "client" => "Client",
    "livreur" => "Livreur"

])]

#[ApiResource(
    
     collectionOperations:  [
   
        "get"=>[
         'method' => 'get',
         'status' => Response::HTTP_OK,
         'normalization_context' => ['groups' => ['User:read:simple']],
     ],
        "post"
    ],
    itemOperations:         ["put","get","delete"],
    
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    // #[Groups(['Burger:read:all'])]
    // #[Groups(['Commande:write','Livraison:write','User:read:simple'])]
    #[Groups(['Commande:write','Commande:read:simple','Commande:read:all','Commande:read:id','Livraison:write','User:read:simple'])]

    // #[Groups(['Burger:read:all','Gestionnaire:read:simple','Livreur:read:simple'])]
    protected $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    //  #[Groups(['Burger:read:all','User:read:simple','Client:read:simple','Gestionnaire:read:simple','Livreur:read:simple'])]
    #[Assert\Email(message:"Le mail n'est pas valide")]
     #[Groups(['User:read:simple'])]
    //  #[Groups(['Gestionnaire:read:simple'])]

    protected $email;

    #[ORM\Column(type: 'json')]
    // #[Groups(['User:read:simple','Client:read:simple','Gestionnaire:read:simple','Livreur:read:simple'])]
    // #[Groups(['User:read:simple'])]
    #[Groups(['Gestionnaire:read:simple','User:read:simple'])]

    protected $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['User:read:simple','Client:read:simple','Gestionnaire:read:simple','Livreur:read:simple'])]
    // #[Groups(['User:read:simple'])]
    #[Groups(['User:read:simple','Gestionnaire:read:simple'])]
    protected $prenom;

    // #[Groups(['User:read:simple','Client:read:simple','Gestionnaire:read:simple','Livreur:read:simple'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['User:read:simple'])]
    #[Groups(['User:read:simple','Gestionnaire:read:simple'])]
    protected $nom;

    #[ORM\Column(type: 'boolean', nullable: true)]
    // #[Groups(['User:read:simple'])]
    
    protected $etat=true;

    #[ORM\Column(type: 'boolean', nullable: true)]
    // #[Groups(['User:read:simple'])]
    protected $is_activate = false;

    // #[Groups(['User:read:simple'])]
    #[ORM\Column(type: 'date', nullable: true)]
    protected $expirate;

    // #[Groups(['User:read:simple'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $generateToken;

    #[SerializedName("password")]
    protected $plainPassword;

    public function __construct(){
        $this->generated();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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
        //  $roles[] = 'ROLE_'.$this->profil->getLibelle();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(?bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function isIsActivate(): ?bool
    {
        return $this->is_activate;
    }

    public function setIsActivate(?bool $is_activate): self
    {
        $this->is_activate = $is_activate;

        return $this;
    }

    public function getExpirate(): ?\DateTimeInterface
    {
        return $this->expirate;
    }

    public function setExpirate(?\DateTimeInterface $expirate): self
    {
        $this->expirate = $expirate;

        return $this;
    }

    public function getGenerateToken(): ?string
    {
        return $this->generateToken;
    }

    public function setGenerateToken(?string $generateToken): self
    {
        $this->generateToken = $generateToken;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function generated(){
        $this->expirate = new \DateTime('+1 day');
        $this->generateToken = rtrim(strtr(base64_encode(random_bytes(128)), '+/', '-_'), '=');
    }

                            
}
