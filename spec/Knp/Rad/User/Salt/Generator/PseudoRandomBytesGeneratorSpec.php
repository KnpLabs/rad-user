<?php

declare(strict_types=1);

namespace spec\Knp\Rad\User\Salt\Generator;

use PhpSpec\ObjectBehavior;

class PseudoRandomBytesGeneratorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(255);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\Salt\Generator\PseudoRandomBytesGenerator');
    }

    function it_is_a_generator()
    {
        $this->shouldHaveType('Knp\Rad\User\Salt\Generator');
    }

    function it_generates_a_string()
    {
        $this->generate()->shouldBeString();
    }

    function it_generates_a_string_with_an_expected_size()
    {
        $this->beConstructedWith(25);

        expect(\strlen($this->generate()->getWrappedObject()))->toBe(25);
    }
}
