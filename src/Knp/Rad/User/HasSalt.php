<?php

namespace Knp\Rad\User;

interface HasSalt
{
    /**
     * @return string
     */
    public function getSalt();

    /**
     * @param string $salt
     *
     * @return HasSalt
     */
    public function setSalt($salt);
}
