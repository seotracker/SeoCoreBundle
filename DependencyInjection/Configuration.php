<?php

/**
 * This file is part of the Seo Core Bundle
 *
 * Copyright (c) 2014 Mickaël Andrieu
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeoTracker\Bundle\SeoCoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('seo_tracker_seo_core');
        $rootNode
            ->children()
                ->scalarNode('crawler')
                    ->defaultValue('%seo_tracker_seo_core.sf_crawler.class%')
                ->end()
                ->scalarNode('scrapper')
                    ->defaultValue('%seo_tracker_seo_core.curl_scrapper.class%')
                ->end()
                ->scalarNode('search_engine')
                    ->defaultValue('%seo_tracker_seo_core.google_engine.class%')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
