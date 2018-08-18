<?php

namespace LireinCore\ImgCacheBundle\DependencyInjection;

//use LireinCore\ImgCacheBundle\Command\ImgCacheCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class LireinCoreImgCacheExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $definition = $container->getDefinition('lireincore_imgcache.service.imgcache');
        $definition->replaceArgument(0, $config);

        // создание определения команды
        //$commandDefinition = new Definition(ImgCacheCommand::class);
        // добавление ссылок на отправителей в конструктор комманды
        /*foreach ($config['senders'] as $serviceId) {
            $commandDefinition->addArgument(new Reference($serviceId));
        }*/
        // регистрация сервиса команды как консольной команды
        //$commandDefinition->addTag('console.command', ['command' => ImgCacheCommand::COMMAND_NAME]);
        // установка определения в контейнер
        //$container->setDefinition(ImgCacheCommand::class, $commandDefinition);
    }

    public function getAlias()
    {
        return 'lireincore_imgcache';
    }
}