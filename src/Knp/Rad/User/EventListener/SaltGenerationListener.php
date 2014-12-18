<?php

namespace Knp\Rad\User\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Knp\Rad\User\Salt\Generator;
use Knp\Rad\User\Salt\Generator\DefaultGenerator;
use Knp\Rad\User\User\HasSalt;

class SaltGenerationListener
{
    /**
     * @var Generator $generator
     */
    private $generator;

    public function __construct()
    {
        $this->generator = new DefaultGenerator();
    }

    public function setGenerator(Generator $generator)
    {
        $this->generator = $generator;

        return $this;
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if (false === $entity instanceof HasSalt) {
            return;
        }

        if (null !== $entity->getSalt()) {
            return;
        }

        $salt = $this->generator->generate();
        $entity->setSalt($salt);
    }
}
