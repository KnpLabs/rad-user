<?php

declare(strict_types=1);

namespace Knp\Rad\User\EventListener\Persistence;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Knp\Rad\User\HasSalt;
use Knp\Rad\User\Salt\Generator;

class SaltGenerationListener
{
    /**
     * @var Generator
     */
    private $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
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
