<?php

namespace Knp\Rad\User\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SaltGeneratorPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $listener = $container->getDefinition('knp.rad.user.event_listener.salt_generation_listener');

        foreach ($container->findTaggedServiceIds('rad.salt_generator') as $id => $tags) {
            $listener->addMethodCall('setGenerator', array(new Reference($id)));
        }
    }
}
