<?php

declare(strict_types=1);

namespace Knp\Rad\User\Bundle;

use Knp\Rad\User\DependencyInjection\UserExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new UserExtension();
    }
}
