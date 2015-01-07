<?php

namespace Knp\Rad\User\HasSalt;

trait HasSalt
{
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
}
