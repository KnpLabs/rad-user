<?php

namespace spec\Knp\Rad\User\Salt\Generator;

use PhpSpec\ObjectBehavior;

class DefaultGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\Salt\Generator\DefaultGenerator');
    }

    function it_is_a_generator()
    {
        $this->shouldHaveType('Knp\Rad\User\Salt\Generator');
    }

    function it_generates_a_string()
    {
        $this->generate()->shouldBeString();
    }
}
