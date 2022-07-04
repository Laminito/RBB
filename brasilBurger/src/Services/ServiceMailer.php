<?php

namespace App\Services;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

    class ServiceMailer{

        public function __construct(MailerInterface $mailer, Environment $environment){
            $this->environment= $environment;
            $this->mailer = $mailer;
        }

        public function sendEmail($user, $object="Création de compte") {
            $email = (new Email())
                ->from('hello@example.com')
                ->to($user->getEmail())
                ->subject($object)
                ->text('Sending emails is fun again!')
                ->html($this->environment->render('mailer/index.html.twig',[
                    'user' => $user
                ]));
    
            $this->mailer->send($email);
        }
    }