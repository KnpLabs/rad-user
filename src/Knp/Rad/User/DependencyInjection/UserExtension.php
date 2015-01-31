<?php

namespace Knp\Rad\User\DependencyInjection;

use Knp\Rad\User\DependencyInjection\Configuration;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class UserExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $tagName = null;
        switch ($config['doctrine_driver']) {
            case 'orm':
                $tagName = 'doctrine.event_listener';
                break;
            case 'mongodb':
                $tagName = 'doctrine_mongodb.odm.event_listener';
                break;
            case 'couchdb':
                $tagName = 'doctrine_couchdb.event_listener';
                break;
        }

        if (null === $tagName) {
            return;
        }

        $container
            ->getDefinition('knp_rad_user.event_listener.password_generation_listener')
            ->addTag($tagName, [
                'event'    => 'prePersist',
                'method'   => 'prePersist',
                'priority' => 200,
            ]);

        $container
            ->getDefinition('knp_rad_user.event_listener.password_hash_listener')
            ->addTag($tagName, [
                'event'    => 'prePersist',
                'method'   => 'prePersist',
                'priority' => 100,
            ])
            ->addTag($tagName, [
                'event'    => 'preUpdate',
                'method'   => 'preUpdate',
            ]);

        $container
            ->getDefinition('knp_rad_user.event_listener.salt_generation_listener')
            ->addTag($tagName, [
                'event'    => 'prePersist',
                'method'   => 'prePersist',
                'priority' => 200,
            ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'knp_rad_user';
    }
}
