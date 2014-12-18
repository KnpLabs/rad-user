<?php

namespace Knp\Rad\User\User;

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
