<?php

namespace Knp\Rad\User\HasSalt;

trait HasSalt
{
    protected $salt;
    
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
