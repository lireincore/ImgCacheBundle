<?php

namespace LireinCore\ImgCacheBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use LireinCore\ImgCacheBundle\Service\ImgCacheInterface;
use LireinCore\ImgCacheBundle\Controller\ImgCacheController;
use LireinCore\ImgCacheBundle\Command\ImgCacheCommand;

class ImgCacheServicesCompilerPath implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(ImgCacheController::class)) {
            return;
        }

        $controller = $container->findDefinition(ImgCacheController::class);
        //$commandDefinition = $container->findDefinition(ImgCacheCommand::class);
        foreach (array_keys($container->findTaggedServiceIds(ImgCacheInterface::TAG)) as $serviceId) {
            $controller->addMethodCall('image', [new Reference($serviceId)]);
            //$commandDefinition->addMethodCall('process', [new Reference($serviceId)]);
        }
    }
}