<?php

namespace spec\Knp\Rad\User\Password\Generator;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HackzillaGeneratorSpec extends ObjectBehavior
{
    function let(ComputerPasswordGenerator $generator)
    {
        $generator->generatePassword()->willReturn('password');
        $generator->setLength(Argument::any())->willReturn(null);
        $generator->setOptions(Argument::any())->willReturn(null);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\Password\Generator\HackzillaGenerator');
    }

    function it_set_password_length($generator)
    {
        $options = array('length' => 20);

        $this->beConstructedWith($options, $generator);
        $generator->setLength(20)->shouldBeCalled();

        $this->generate();
    }

    function it_change_password_config($generator)
    {
        $options = array('uppercase' => true, 'numeric' => false);
        $result = ComputerPasswordGenerator::OPTION_AVOID_SIMILAR
            | ComputerPasswordGenerator::OPTION_UPPER_CASE
            | ComputerPasswordGenerator::OPTION_LOWER_CASE
        ;

        $this->beConstructedWith($options, $generator);
        $generator->setOptions($result)->shouldBeCalled();

        $this->generate();
    }

    function it_generate_a_password($generator)
    {
        $this->beConstructedWith(array(), $generator);

        $this->generate()->shouldReturn('password');;
    }
}
