<?php

namespace Knp\Rad\User\EventListener\Persistence;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Knp\Rad\User\HasSalt;
use Knp\Rad\User\Salt\Generator;
use Knp\Rad\User\Salt\Generator\DefaultGenerator;

class SaltGenerationListener
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * @param Generator|null $generator
     */
    public function __construct(Generator $generator = null)
    {
        $this->generator = null !== $generator ? $generator : new DefaultGenerator();
    }

    /**
     * @param LifecycleEventArgs $event
     *
     * @return false|void False if nothing was done
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        $object = $event->getObject();

        if (false === $object instanceof HasSalt) {
            return false;
        }

        if (null !== $object->getSalt()) {
            return false;
        }

        $salt = $this->generator->generate();
        $object->setSalt($salt);
    }
}
