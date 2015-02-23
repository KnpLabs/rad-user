<?php

namespace Knp\Rad\User\EventListener\Persistence;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Knp\Rad\User\HasInitialPassword;
use Knp\Rad\User\Password\Generator;
use Knp\Rad\User\Password\Generator\HackzillaGenerator;

class PasswordGenerationListener
{
    /**
     * @var Generator $generator
     */
    private $generator;

    /**
     * @param Generator|null $generator
     */
    public function __construct(Generator $generator = null)
    {
        $this->generator = null !== $generator ? $generator : new HackzillaGenerator();
    }

    /**
     * @param LifecycleEventArgs $event
     *
     * @return false|void False if nothing was done
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        $object = $event->getObject();

        if (false === $object instanceof HasInitialPassword) {
            return false;
        }

        if (null !== $object->getPlainPassword()) {
            return false;
        }

        $plainPassword = $this->generator->generate();
        $object->setPlainPassword($plainPassword);
    }
}
