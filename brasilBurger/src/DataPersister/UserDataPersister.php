<?php

namespace App\DataPersister;


use App\Entity\User;
use App\Services\ServiceMailer;
use App\DataPersister\UserDataPersister;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{

    public function __construct( EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder,ServiceMailer $service_mailer)
    {
        $this->service_mailer=$service_mailer;
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

   
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     */
    public function persist($data, array $context = [])
    {
        if ($data->getPlainPassword()) {
            $password = $this->encoder->hashPassword($data,$data->getPlainPassword());
            $data->setPassword($password);
            $data->eraseCredentials();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
            $this->service_mailer->sendEmail($data);
        }
    }

    
    public function remove($data, array $context = [])
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}