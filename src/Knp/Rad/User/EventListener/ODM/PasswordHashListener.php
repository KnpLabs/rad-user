<?php

namespace Knp\Rad\User\EventListener\ODM;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Knp\Rad\User\EventListener\Persistence\PasswordHashListener as WrappedListener;

class PasswordHashListener
{
    /**
     * @var WrappedListener
     */
    private $wrapped;

    public function __construct(WrappedListener $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    /**
     * @param LifecycleEventArgs $event
     *
     * @return false|void False if nothing was done
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        return $this->wrapped->prePersist($event);
    }

    /**
     * @param LifecycleEventArgs $event
     *
     * @return false|void False if nothing was done
     */
    public function preUpdate(LifecycleEventArgs $event)
    {
        $return = $this->wrapped->preUpdate($event);

        if (false === $return) {
            return false;
        }

        $object = $event->getObject();
        $om     = $event->getObjectManager();
        $uow    = $om->getUnitOfWork();
        $meta   = $om->getClassMetadata(get_class($object));
        $uow->recomputeSingleDocumentChangeSet($meta, $object);
    }
}
