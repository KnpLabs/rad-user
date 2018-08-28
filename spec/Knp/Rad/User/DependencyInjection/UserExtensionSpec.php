<?php

declare(strict_types=1);

namespace spec\Knp\Rad\User\DependencyInjection;

use PhpSpec\ObjectBehavior;

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
