Rapid Application Development : User
====================================
Simply handle password encryption and salt generation

[![Build Status](https://travis-ci.org/KnpLabs/rad-user.svg?branch=master)](https://travis-ci.org/KnpLabs/rad-user)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/KnpLabs/rad-user/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/KnpLabs/rad-user/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/knplabs/rad-user/v/stable)](https://packagist.org/packages/knplabs/rad-user) [![Total Downloads](https://poser.pugx.org/knplabs/rad-user/downloads)](https://packagist.org/packages/knplabs/rad-user) [![Latest Unstable Version](https://poser.pugx.org/knplabs/rad-user/v/unstable)](https://packagist.org/packages/knplabs/rad-user) [![License](https://poser.pugx.org/knplabs/rad-user/license)](https://packagist.org/packages/knplabs/rad-user)

#Installation

```bash
composer require knplabs/rad-user ~1.0
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

Your User model should implement the `Knp\Rad\User\HasSalt` interface.

```php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\Rad\User\HasSalt;

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

##I want to auto-generate my user password

Your User model should implement the `Knp\Rad\User\HasInitialPassword` interface.

```php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\Rad\User\HasInitialPassword;

/**
 * @ORM\Entity
 */
class User implements HasInitialPassword
{
    use HasInitialPassword\HasInitialPassword; // You can also use this trait

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

Now, before your user is inserted or updated into your database, then the plain password will be automaticly generated.

##I want to auto-encode my user password

Your User model should implement the `Knp\Rad\User\HasPassword` interface.

```php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\Rad\User\HasPassword;

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

#WARNING

The `Knp\Rad\User\HasPassword\HasPassword` trait use the `Knp\Rad\User\HasInitialPassword\HasInitialPassword` trait. So don't use both into the same class or you will have a method conflict.

#Some tips

##Change the salt generator

You can use your own salt generator. You just have to declare a service implementing the `Knp\Rad\User\Salt\Generator` interface and tag it with `knp_rad_user.salt_generator`.

##Change the initial password generator

You can change the default password generator. By default, the rad-users uses the [hackzilla/password-generator](https://github.com/hackzilla/password-generator). You can chenga it by implementing the `Knp\Rad\User\Password\Generator` interface and tag the service with the `knp_rad_user.password_generator` tag.

##Using with MongoDB or CouchDB Object Document Mapper

The knp/rad-user library is also compatible with MongoDB and CouchDB
