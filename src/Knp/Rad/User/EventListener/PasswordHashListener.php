<?php

namespace Knp\Rad\User\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Knp\Rad\User\HasPassword;
use Knp\Rad\User\HasSalt;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordHashListener
{
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        $this->process($entity);
    }

    public function preUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        $this->process($entity);
    }

    private function process($entity)
    {
        if (false === $entity instanceof HasPassword) {
            return;
        }

        if (null === $entity->getPlainPassword()) {
            return;
        }

        $this->updatePasswordHash($entity);
    }

    private function updatePasswordHash(HasPassword $entity)
    {
        $password = $this->generatePassword($this->encoderFactory->getEncoder($entity), $entity);
        $entity->setPassword($password);

        if ($entity instanceof UserInterface) {
            $entity->eraseCredentials();
        }
    }

    public function generatePassword(PasswordEncoderInterface $encoder, HasPassword $entity)
    {
        $salt = '';

        if ((true === $entity instanceof HasSalt) || (true === $entity instanceof UserInterface)) {
            $salt = $entity->getSalt();
        }

        return $encoder->encodePassword($entity->getPlainPassword(), $salt);
    }
}
