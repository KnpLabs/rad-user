<?php

namespace Knp\Rad\User\Salt\Generator;

use Knp\Rad\User\Salt\Generator;

class DefaultGenerator implements Generator
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        return md5(uniqid().time());
    }
}
