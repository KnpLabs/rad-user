<?php

namespace Knp\Rad\User\Password\Generator;

trigger_error(E_USER_DEPRECATED, 'UniqidGenerator is now deprecated and will be removed in future versions.');

use Knp\Rad\User\Password\Generator;

/**
 * @deprecated Use Knp\Rad\User\Password\Generator\PseudoRandomBytesGenerator instead
 */
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
