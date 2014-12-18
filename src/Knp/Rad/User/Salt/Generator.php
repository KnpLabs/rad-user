<?php

namespace Knp\Rad\User\Salt;

interface Generator
{
    /**
     * @return string
     */
    public function generate();
}
