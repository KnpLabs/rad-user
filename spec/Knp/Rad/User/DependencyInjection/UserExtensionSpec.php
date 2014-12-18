<?php

namespace spec\Knp\Rad\User\DependencyInjection;

use Knp\Rad\User\DependencyInjection\Compiler\SaltGeneratorPass;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\DependencyInjection\UserExtension');
    }

    function it_is_an_extension()
    {
        $this->shouldHaveType('Symfony\Component\DependencyInjection\Extension\Extension');
    }
}
