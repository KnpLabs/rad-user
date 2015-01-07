<?php

namespace Knp\Rad\User;

interface HasPassword
{
    /**
     * @param string $password
     *
     * @return HasPassword
     */
    public function setPassword($password);

    /**
     * @return string
     */
    public function getPlainPassword();

    /**
     * @param string $plainPassword
     *
     * @return HasPassword
     */
    public function setPlainPassword($plainPassword);

    /**
     * @return HasPassword
     */
    public function eraseCredentials();
}
