<?php

namespace spec\Knp\Rad\User\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Knp\Rad\User\User\HasPassword;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PasswordHashListenerSpec extends ObjectBehavior
{
    function let(EncoderFactoryInterface $factory, PasswordEncoderInterface $encoder, HasPassword $user, LifecycleEventArgs $event)
    {
        $user->implement('Symfony\Component\Security\Core\User\UserInterface');
        $user->getPlainPassword()->willReturn('password');
        $user->getSalt()->willReturn('salt');
        $user->setPassword(Argument::any())->willReturn(null);
        $user->eraseCredentials()->willReturn(null);

        $event->getEntity()->willReturn($user);

        $factory->getEncoder($user)->willReturn($encoder);

        $encoder->encodePassword('password', 'salt')->willReturn('encoded');

        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\EventListener\PasswordHashListener');
    }

    function it_erases_credentials_if_user($user, $event)
    {
        $user->eraseCredentials()->shouldBeCalled();

        $this->prePersist($event);
    }

    function it_encodes_password($user, $event)
    {
        $user->setPassword('encoded')->shouldBeCalled();

        $this->prePersist($event);
    }

    function it_doesnt_set_password_if_there_is_no_plain_value($user, $event)
    {
        $user->getPlainPassword()->willReturn(null);
        $user->setPassword(Argument::any())->shouldNotBeCalled();

        $this->prePersist($event);
    }
}
