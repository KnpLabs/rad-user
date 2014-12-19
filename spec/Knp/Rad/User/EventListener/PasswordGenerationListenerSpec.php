<?php

namespace spec\Knp\Rad\User\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Knp\Rad\User\Password\Generator;
use Knp\Rad\User\User\HasInitialPassword;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordGenerationListenerSpec extends ObjectBehavior
{
    function let(Generator $generator, HasInitialPassword $user, LifecycleEventArgs $event)
    {
        $generator->generate()->willReturn('password');
        $event->getEntity()->willReturn($user);

        $user->getPlainPassword()->willReturn(null);

        $this->beConstructedWith($generator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\EventListener\PasswordGenerationListener');
    }

    function it_set_plain_password_if_needed($user, $event)
    {
        $user->setPlainPassword('password')->shouldBeCalled();

        $this->prePersist($event);
    }

    function it_doesnt_overwrite_plain_password($user, $event)
    {
        $user->getPlainPassword()->willReturn('password');
        $user->setPlainPassword(Argument::any())->shouldNotBeCalled();

        $this->prePersist($event);
    }
}
