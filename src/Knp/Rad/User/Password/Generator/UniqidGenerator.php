<?php

declare(strict_types=1);

namespace Knp\Rad\User\Password\Generator;

use Knp\Rad\User\Password\Generator;

class UniqidGenerator implements Generator
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        return uniqid();
    }
}
