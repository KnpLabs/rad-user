<?php

namespace spec\Knp\Rad\User\Bundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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

    function it_register_salt_generator_pass(ContainerBuilder $container)
    {
        $container->addCompilerPass(Argument::type('Knp\Rad\User\DependencyInjection\Compiler\SaltGeneratorPass'))->shouldBeCalled();

        $this->build($container);
    }
}
