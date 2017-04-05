<?php

namespace spec\Knp\Rad\User\Bundle;

use PhpSpec\ObjectBehavior;

class UserBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\Bundle\UserBundle');
    }

    function it_is_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }
}
