<?php

namespace Knp\Rad\User\HasPassword;

use Knp\Rad\User\HasInitialPassword\HasInitialPassword;

trait HasPassword
{
    use HasInitialPassword;

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
