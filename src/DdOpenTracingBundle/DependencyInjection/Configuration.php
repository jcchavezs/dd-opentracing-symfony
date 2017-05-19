<?php

namespace DdOpenTracingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dd-opentracing');

        $rootNode
            ->children()
                ->scalarNode('tracer')->defaultValue('noop')->end()
                ->scalarNode('transport')->defaultValue('noop')->end()
                ->scalarNode('encoder')->defaultValue('json')->end()
                ->arrayNode('datadog')->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('service_url')->defaultValue('localhost:8126')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
