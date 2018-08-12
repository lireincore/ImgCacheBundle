<?php

namespace LireinCore\ImgCacheBundle\DependencyInjection;

use LireinCore\ImgCacheBundle\Command\ImgCacheCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

class LireinCoreImgCacheExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        //'%kernel.project_dir%/public'
        //"@=service('request_stack').getCurrentRequest().getSchemeAndHttpHost()"

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        // создание определения команды
        $commandDefinition = new Definition(ImgCacheCommand::class);
        // добавление ссылок на отправителей в конструктор комманды
        /*foreach ($config['senders'] as $serviceId) {
            $commandDefinition->addArgument(new Reference($serviceId));
        }*/
        // регистрация сервиса команды как консольной команды
        $commandDefinition->addTag('console.command', ['command' => ImgCacheCommand::COMMAND_NAME]);
        // установка определения в контейнер
        $container->setDefinition(ImgCacheCommand::class, $commandDefinition);
    }
}