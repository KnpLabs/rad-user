<?php

namespace Knp\Rad\User;

interface HasInitialPassword
{
    /**
     * @return string
     */
    public function getPlainPassword();

    /**
     * @param string $plainPassword
     *
     * @return HasInitialPassword
     */
    public function setPlainPassword($plainPassword);
}
