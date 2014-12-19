<?php

namespace Knp\Rad\User\Bundle;

use Knp\Rad\User\DependencyInjection\Compiler\SaltGeneratorPass;
use Knp\Rad\User\DependencyInjection\UserExtension;
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
    public function getContainerExtension()
    {
        return new UserExtension();
    }
}
