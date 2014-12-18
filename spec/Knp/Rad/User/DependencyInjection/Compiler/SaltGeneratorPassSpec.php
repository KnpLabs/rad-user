<?php

namespace spec\Knp\Rad\User\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SaltGeneratorPassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\DependencyInjection\Compiler\SaltGeneratorPass');
    }
}
