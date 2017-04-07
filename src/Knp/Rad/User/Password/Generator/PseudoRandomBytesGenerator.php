<?php

namespace Knp\Rad\User\Password\Generator;

use Knp\Rad\User\Password\Generator;

class PseudoRandomBytesGenerator implements Generator
{
    /**
     * @var int
     */
    private $length;

    /**
     * @param int $length
     */
    public function __construct($length)
    {
        $this->length = $length;
    }

    public function generate()
    {
        return openssl_random_pseudo_bytes($this->length);
    }
}
