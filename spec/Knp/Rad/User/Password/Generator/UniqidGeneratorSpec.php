<?php

namespace spec\Knp\Rad\User\Password\Generator;

use PhpSpec\ObjectBehavior;

class UniqidGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\Password\Generator\UniqidGenerator');
    }

    function it_generates_a_string()
    {
        $this->generate()->shouldBeString();
    }
}
