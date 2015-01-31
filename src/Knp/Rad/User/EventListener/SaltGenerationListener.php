<?php

namespace Knp\Rad\User\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Knp\Rad\User\Salt\Generator;
use Knp\Rad\User\Salt\Generator\DefaultGenerator;
use Knp\Rad\User\HasSalt;

class SaltGenerationListener
{
    /**
     * @var Generator $generator
     */
    private $generator;

    public function __construct(Generator $generator = null)
    {
        $this->generator = null !== $generator ? $generator : new DefaultGenerator();
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
