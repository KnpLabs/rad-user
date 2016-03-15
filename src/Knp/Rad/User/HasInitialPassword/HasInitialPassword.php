<?php

namespace Knp\Rad\User\HasInitialPassword;

trait HasInitialPassword
{
    /**
     * @var string
     */
    protected $plainPassword;

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
}
