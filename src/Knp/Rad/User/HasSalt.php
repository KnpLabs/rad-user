<?php

namespace Knp\Rad\User;

/**
 * @deprecated The salt feature is deprecated since PHP 5.5 and BCrypt usage. Please upgrade your version of PHP and use BCrypt
 */
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
