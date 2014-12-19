<?php

namespace Knp\Rad\User\Password;

interface Generator
{
    /**
     * @return string
     */
    public function generate();
}
