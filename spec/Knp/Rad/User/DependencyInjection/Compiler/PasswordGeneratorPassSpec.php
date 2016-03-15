<?php

namespace spec\Knp\Rad\User\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;

class PasswordGeneratorPassSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\Rad\User\DependencyInjection\Compiler\PasswordGeneratorPass');
    }
}
