<?php

namespace Knp\Rad\User\EventListener\Persistence;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Knp\Rad\User\HasPassword;
use Knp\Rad\User\HasSalt;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordHashListener
{
    /**
     * @var EncoderFactoryInterface $encoderFactory
     */
    private $encoderFactory;

    /**
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param LifecycleEventArgs $event
     *
     * @return false|void False if nothing was done
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        $object = $event->getObject();

        return $this->process($object);
    }

    /**
     * @param LifecycleEventArgs $event
     *
     * @return false|void False if nothing was done
     */
    public function preUpdate(LifecycleEventArgs $event)
    {
        $object = $event->getObject();

        return $this->process($object);
    }

    private function process($object)
    {
        if (false === $object instanceof HasPassword) {
            return false;
        }

        if (null === $object->getPlainPassword()) {
            return false;
        }

        $this->updatePasswordHash($object);
    }

    private function updatePasswordHash(HasPassword $object)
    {
        $password = $this->generatePassword($this->encoderFactory->getEncoder($object), $object);
        $object->setPassword($password);

        if ($object instanceof UserInterface) {
            $object->eraseCredentials();
        }
    }

    public function generatePassword(PasswordEncoderInterface $encoder, HasPassword $object)
    {
        $salt = '';

        if ((true === $object instanceof HasSalt) || (true === $object instanceof UserInterface)) {
            $salt = $object->getSalt();
        }

        return $encoder->encodePassword($object->getPlainPassword(), $salt);
    }
}
