<?php

declare(strict_types=1);

namespace Knp\Rad\User\EventListener\Persistence;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Knp\Rad\User\HasInitialPassword;
use Knp\Rad\User\Password\Generator;
use Knp\Rad\User\Password\Generator\UniqidGenerator;

class PasswordGenerationListener
{
    /**
     * @var Generator
     */
    private $generator;

    public function __construct(Generator $generator = null)
    {
        $this->generator = null !== $generator ? $generator : new UniqidGenerator();
    }

    /**
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
