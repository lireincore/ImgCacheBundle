<?php

namespace LireinCore\ImgCacheBundle\Tests;

use LireinCore\ImgCacheBundle\Service\ImgCache;
use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new LireinCoreImgCacheTestingKernel($this->config());
        $kernel->boot();
        $container = $kernel->getContainer();

        $imgCache = $container->get('lireincore_imgcache.service.imgcache');
        $this->assertInstanceOf(ImgCache::class, $imgCache);
    }

    public function testServiceWiringWithConfiguration()
    {
        $kernel = new LireinCoreImgCacheTestingKernel($this->config());
        $kernel->boot();
        $container = $kernel->getContainer();

        $imgCache = $container->get('lireincore_imgcache.service.imgcache');
        $this->assertInstanceOf(ImgCache::class, $imgCache);
    }

    protected function config()
    {
        return [
            'destdir' => __DIR__ . '/cache/thumbs'
        ];
    }
}