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
                ->enumNode('doctrine_driver')
                    ->values(['orm', 'mongodb', 'couchdb'])
                    ->defaultValue('orm')
                ->end();

        return $treeBuilder;
    }
}
