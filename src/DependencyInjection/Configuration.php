<?php

declare(strict_types=1);

namespace Bigoen\MercureTwigBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bigoen_mercure_twig');
        $treeBuilder
            ->getRootNode()
                ->children()
                    ->scalarNode('public_url')->isRequired()->end()
                    ->scalarNode('subscriber_js')->defaultValue('@BigoenMercureTwig\subscriber_js.html.twig')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
