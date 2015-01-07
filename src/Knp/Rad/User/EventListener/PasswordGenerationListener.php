<?php

namespace Knp\Rad\User\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Knp\Rad\User\Password\Generator;
use Knp\Rad\User\Password\Generator\HackzillaGenerator;
use Knp\Rad\User\HasInitialPassword;

class PasswordGenerationListener
{
    /**
     * @var Generator $generator
     */
    private $generator;

    public function __construct(Generator $generator = null)
    {
        $this->generator = null !== $generator ? $generator : new HackzillaGenerator();
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if (false === $entity instanceof HasInitialPassword) {
            return;
        }

        if (null !== $entity->getPlainPassword()) {
            return;
        }

        $plainPassword = $this->generator->generate();
        $entity->setPlainPassword($plainPassword);
    }
}
