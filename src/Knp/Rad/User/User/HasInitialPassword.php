<?php

namespace Knp\Rad\User\User;

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
