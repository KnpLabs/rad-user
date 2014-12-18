<?php

namespace Knp\Rad\User\Bundle;

use Knp\Rad\User\DependencyInjection\Compiler\SaltGeneratorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SaltGeneratorPass());
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensionClass()
    {
        return 'Knp\Rad\User\DependencyInjection\UserExtension';
    }
}
