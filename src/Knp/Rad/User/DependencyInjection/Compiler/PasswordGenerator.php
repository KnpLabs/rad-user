<?php

namespace Knp\Rad\User\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\OutOfBoundsException;

class PasswordGenerator implements CompilerPassInterface
{
    const GENERATOR_INDEX = 0;

    public function process(ContainerBuilder $container)
    {
        if ( ! extension_loaded('openssl')) {
            return;
        }

        $listener = $container->findDefinition('knp_rad_user.event_listener.persistence.password_generation_listener');

        try {
            $generator = $listener->getArgument(self::GENERATOR_INDEX);
        } catch (OutOfBoundsException $e) {
            $sslGenerator = $container->findDefinition('knp_rad_user.password.generator.pseudo_random_bytes_generator');
            $listener->setArguments([$sslGenerator]);
        }
    }
}
