<?php

namespace LireinCore\ImgCacheBundle\Tests;

use LireinCore\ImgCacheBundle\LireinCoreImgCacheBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LireinCoreImgCacheTestingKernel extends Kernel
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;

        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new LireinCoreImgCacheBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) use ($loader) {
            $container->loadFromExtension('lireincore_imgcache', $this->config);
        });
    }

    public function getCacheDir()
    {
        return __DIR__ . '/cache/' . spl_object_hash($this);
    }
}