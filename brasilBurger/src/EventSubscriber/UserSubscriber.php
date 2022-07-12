<?php

namespace App\EventSubscriber;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Boisson;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private ?TokenInterface $token;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage->getToken();
    }
    //Ecouteur d'événement
    public static function getSubscribedEvents(): array
    {
        return [
        Events::prePersist,
        ];
    }
    //Cette fonction retourne le user stocké dans le token
    private function getUser()
    {
            if (null === $token = $this->token) {
            return null;
        }
            if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return null; 
        }
        return $user;
    }

    public function prePersist(LifecycleEventArgs $args){
        if($args->getObject() instanceof Burger or $args->getObject() instanceof Boisson or $args->getObject() instanceof Frite or $args->getObject() instanceof Menu) {
            $args->getObject()->setGestionnaire($this->getUser());                  
        }

        // if($args->getObject() instanceof Menu){

        //     dd($args->getObject());
        // }
    }
}
