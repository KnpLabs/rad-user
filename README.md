Rapid Application Development : User
====================================
Simply handle password encryption and salt generation

[![Build Status](https://travis-ci.org/KnpLabs/rad-user.svg?branch=master)](https://travis-ci.org/KnpLabs/rad-user)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/KnpLabs/rad-user/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/KnpLabs/rad-user/?branch=master)

#Installation

```bash
composer require knplabs/rad-user ~0.1@dev
```

```php
class AppKernel
{
    function registerBundles()
    {
        $bundles = array(
            //...
            new Knp\Rad\User\Bundle\UserBundle(),
            //...
        );

        //...

        return $bundles;
    }
}
```

#Usages

##I want to auto-generate my user salt

Your User model should implement the `Knp\Rad\User\User\HasSalt` interface.

```php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\Rad\User\User\HasSalt;

/**
 * @ORM\Entity
 */
class User implements HasSalt
{
    use HasSalt\HasSalt; //You can also use this trait

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column
     */
    private $salt;
}
```

Now, before your user is inserted into your database, the salt will be auto-generated.

##I want to auto-encode my user password

Your User model should implement the `Knp\Rad\User\User\HasPassword` interface.

```php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\Rad\User\User\HasPassword;

/**
 * @ORM\Entity
 */
class User implements HasPassword
{
    use HasPassword\HasPassword; // You can also use this trait

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column
     */
    private $password;
}
```

Now, before your user is inserted or updated into your database, if you have set the attribute 'plainPassword', then the password will be automaticly generated.

#Some tips

##Change the salt generator

You can use your own salt generator. You just have to declare a service implementing the `Knp\Rad\User\Salt\Generator` interface and tag it with the tag `rad.salt_generator`.
