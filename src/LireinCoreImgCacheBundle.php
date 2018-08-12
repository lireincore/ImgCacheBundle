<?php

namespace LireinCore\ImgCacheBundle;

use LireinCore\ImgCacheBundle\DependencyInjection\LireinCoreImgCacheExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use LireinCore\ImgCacheBundle\Service\ImgCacheInterface;
use LireinCore\ImgCacheBundle\DependencyInjection\Compiler\ImgCacheServicesCompilerPath;

class LireinCoreImgCacheBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ImgCacheServicesCompilerPath());
        $container->registerForAutoconfiguration(ImgCacheInterface::class)->addTag(ImgCacheInterface::TAG);

        /** @var LireinCoreImgCacheExtension $extension */
        //$extension = $container->getExtension('lireincore_imgcache');
    }
}