<?php

declare(strict_types=1);

namespace Knp\Rad\User\Salt\Generator;

use Knp\Rad\User\Salt\Generator;

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

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        return openssl_random_pseudo_bytes($this->length);
    }
}
