<?php

namespace Knp\Rad\User\Bundle;

use Knp\Rad\User\DependencyInjection\Compiler\PasswordGenerator;
use Knp\Rad\User\DependencyInjection\UserExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new PasswordGenerator());
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new UserExtension();
    }
}
