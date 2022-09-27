<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\MailerController;
use App\Repository\ClientRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]


#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Client:read:simple']],
           
         ],
         "post"
     ],
     itemOperations:         [
         "get",
         "put"=>[
             'method' => 'put',
             'security'=>"is_granted('ROLE_CLIENT')",
             'security_messages' => "Vous n'avez pas acces à cette ressource" 
         ],
 ],
    )]

class Client extends User
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['Client:read:simple'])]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['Client:read:simple'])]
    private $adresse;


    public function __construct(){
        parent::__construct();
         $this->roles=['ROLE_CLIENT'];
      
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
