<?php

namespace Knp\Rad\User\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('knp_rad_user');

        $rootNode
            ->children()
                ->scalarNode('doctrine_driver')
                    ->validate()
                        ->ifNotInArray(['orm', 'mongodb', 'couchdb'])
                        ->thenInvalid('Invalid Doctrine driver %s.')
                    ->end()
                    ->defaultValue('orm')
                    ->cannotBeEmpty()
                ->end();

        return $treeBuilder;
    }
}
