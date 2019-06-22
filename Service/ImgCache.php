<?php

namespace LireinCore\ImgCacheBundle\Service;

use Psr\Log\LoggerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use LireinCore\ImgCache\ImgCache as ImgCacheService;
use LireinCore\ImgCache\Exception\ConfigException;

final class ImgCache
{
    /**
     * @var ImgCacheService
     */
    private $imgcache;

    /**
     * ImgCache constructor.
     *
     * @param array $config
     * @param null|LoggerInterface $logger
     * @param null|EventDispatcherInterface $eventDispatcher
     * @throws ConfigException
     */
    public function __construct(
        array $config,
        ?LoggerInterface $logger = null,
        ?EventDispatcherInterface $eventDispatcher = null
    )
    {
        $this->imgcache = new ImgCacheService($config, $logger, $eventDispatcher);
    }

    /**
     * @param string $srcPath absolute or relative path to source image
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $absolute
     * @param bool $useStub
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function url(string $srcPath, $preset, bool $absolute = false, bool $useStub = true) : string
    {
        return $this->imgcache->url($srcPath, $preset, $absolute, $useStub);
    }

    /**
     * @param string $srcPath absolute or relative path to source image
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $useStub
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function path(string $srcPath, $preset, bool $useStub = true) : string
    {
        return $this->imgcache->path($srcPath, $preset, $useStub);
    }

    /**
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $absolute
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function stubUrl($preset, bool $absolute = false) : string
    {
        return $this->imgcache->stubUrl($preset, $absolute);
    }

    /**
     * @param string|array $preset preset name or dynamic preset definition
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function stubPath($preset) : string
    {
        return $this->imgcache->stubPath($preset);
    }

    /**
     * @param string|array|null $preset preset name or dynamic preset definition
     * @throws ConfigException
     */
    public function clearCache($preset = null) : void
    {
        $this->imgcache->clearCache($preset);
    }
}