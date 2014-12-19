<?php

namespace spec\Knp\Rad\User\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Knp\Rad\User\Salt\Generator;
use Knp\Rad\User\User\HasSalt;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SaltGenerationListenerSpec extends ObjectBehavior
{
    function let(Generator $generator, HasSalt $user, LifecycleEventArgs $event)
    {
        $generator->generate()->willReturn('salt');
        $event->getEntity()->willReturn($user);

        $user->getSalt()->willReturn(null);

        $this->beConstructedWith($generator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\EventListener\SaltGenerationListener');
    }

    function it_set_salt_if_needed($user, $event)
    {
        $user->setSalt('salt')->shouldBeCalled();

        $this->prePersist($event);
    }

    function it_doesnt_overwrite_salt($user, $event)
    {
        $user->getSalt()->willReturn('salt');
        $user->setSalt(Argument::any())->shouldNotBeCalled();

        $this->prePersist($event);
    }
}
