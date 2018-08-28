<?php

declare(strict_types=1);

namespace Knp\Rad\User\Salt;

interface Generator
{
    /**
     * @return string
     */
    public function generate();
}
