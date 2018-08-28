<?php

declare(strict_types=1);

namespace Knp\Rad\User\HasInitialPassword;

trait HasInitialPassword
{
    /**
     * @var string
     */
    protected $plainPassword;

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return self
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
}
