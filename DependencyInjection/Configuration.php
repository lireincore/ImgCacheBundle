<?php

namespace LireinCore\ImgCacheBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use LireinCore\Image\ImageHelper;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('lireincore_imgcache');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->fixXmlConfig('postprocessor', 'postprocessors')
            ->fixXmlConfig('preset', 'presets')
            ->validate()
                ->always(static function($v) {
                    if (empty($v['plug'])) {
                        unset($v['plug']);
                    }
                    if (empty($v['convert_map'])) {
                        unset($v['convert_map']);
                    }
                    if (empty($v['effects_map'])) {
                        unset($v['effects_map']);
                    }
                    if (empty($v['postprocessors_map'])) {
                        unset($v['postprocessors_map']);
                    }
                    if (empty($v['postprocessors'])) {
                        unset($v['postprocessors']);
                    }
                    if (empty($v['presets'])) {
                        unset($v['presets']);
                    }

                    return $v;
                })
            ->end()
            ->children()
                ->enumNode('driver')->values(ImageHelper::supportedDrivers())
                    ->info('Graphic library for all presets (by default, tries to use: imagick->gd->gmagick)')->end()
                ->scalarNode('image_class')->end()
                ->scalarNode('srcdir')->end()
                ->scalarNode('destdir')->isRequired()->end()
                ->scalarNode('webdir')->end()
                ->scalarNode('baseurl')->end()
                ->integerNode('jpeg_quality')->min(0)->max(100)->end()
                ->integerNode('png_compression_level')->min(0)->max(9)->end()
                ->integerNode('png_compression_filter')->min(0)->max(9)->end()
                ->append($this->plugNode())
                ->append($this->convertMapNode())
                ->arrayNode('effects_map')
                    ->useAttributeAsKey('name')
                    ->normalizeKeys(false)
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('postprocessors_map')
                    ->useAttributeAsKey('name')
                    ->normalizeKeys(false)
                    ->scalarPrototype()->end()
                ->end()
                ->append($this->postprocessorsNode())
                ->append($this->presetsNode())
            ->end();

        return $treeBuilder;
    }

    protected function presetsNode()
    {
        $treeBuilder = new TreeBuilder('presets');
        $node = $treeBuilder->getRootNode();

        $node
            ->useAttributeAsKey('name')
            ->arrayPrototype()
                ->fixXmlConfig('effect', 'effects')
                ->fixXmlConfig('postprocessor', 'postprocessors')
                ->validate()
                    ->always(static function($v) {
                        if (empty($v['plug'])) {
                            unset($v['plug']);
                        }
                        if (empty($v['convert_map'])) {
                            unset($v['convert_map']);
                        }
                        if (empty($v['effects'])) {
                            unset($v['effects']);
                        }
                        if (empty($v['postprocessors'])) {
                            unset($v['postprocessors']);
                        }

                        return $v;
                    })
                ->end()
                ->children()
                    ->enumNode('driver')->values(ImageHelper::supportedDrivers())->end()
                    ->scalarNode('image_class')->end()
                    ->scalarNode('srcdir')->end()
                    ->scalarNode('destdir')->end()
                    ->scalarNode('webdir')->end()
                    ->scalarNode('baseurl')->end()
                    ->integerNode('jpeg_quality')->min(0)->max(100)->end()
                    ->integerNode('png_compression_level')->min(0)->max(9)->end()
                    ->integerNode('png_compression_filter')->min(0)->max(9)->end()
                    ->append($this->plugNode())
                    ->append($this->convertMapNode())
                    ->append($this->effectsNode())
                    ->append($this->postprocessorsNode())
                ->end()
            ->end();

        return $node;
    }

    protected function plugNode()
    {
        $treeBuilder = new TreeBuilder('plug');
        $node = $treeBuilder->getRootNode();

        $node
            ->children()
                ->scalarNode('path')->end()
                ->scalarNode('url')->end()
                ->booleanNode('process')->end()
            ->end();

        return $node;
    }

    protected function convertMapNode()
    {
        $treeBuilder = new TreeBuilder('convert_map');
        $node = $treeBuilder->getRootNode();

        $node
            ->useAttributeAsKey('name')
            ->normalizeKeys(false)
            ->enumPrototype()->values(ImageHelper::supportedDestinationFormats())->end();

        return $node;
    }

    protected function effectsNode()
    {
        $treeBuilder = new TreeBuilder('effects');
        $node = $treeBuilder->getRootNode();

        return $this->configureEffectsOrPostprocessorsNode($node);
    }

    protected function postprocessorsNode()
    {
        $treeBuilder = new TreeBuilder('postprocessors');
        $node = $treeBuilder->getRootNode();

        return $this->configureEffectsOrPostprocessorsNode($node);
    }

    protected function configureEffectsOrPostprocessorsNode(ArrayNodeDefinition $node)
    {
        $node
            ->performNoDeepMerging()
            ->arrayPrototype()
                ->beforeNormalization()
                    ->ifString()
                    ->then(static function ($v) { return ['type' => $v]; })
                ->end()
                ->validate()
                    ->always(static function($v) {
                        if (empty($v['params'])) {
                            unset($v['params']);
                        }

                        return $v;
                    })
                ->end()
                ->children()
                    ->scalarNode('type')->isRequired()->end()
                    ->arrayNode('params')
                        ->useAttributeAsKey('name')
                        ->normalizeKeys(false)
                        ->variablePrototype()->end()
                    ->end()
                ->end()
            ->end();

        return $node;
    }
}