<?php

namespace Knp\Rad\User\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class PasswordGeneratorPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $listener = $container->getDefinition('knp_rad_user.event_listener.persistence.password_generation_listener');

        foreach ($container->findTaggedServiceIds('knp_rad_user.password_generator') as $id => $tags) {
            $listener->setArguments([new Reference($id)]);
        }
    }
}
