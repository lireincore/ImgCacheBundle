<?php

namespace LireinCore\ImgCacheBundle\Service;

use LireinCore\ImgCache\ImgCache as ImgCacheService;
use LireinCore\ImgCache\Exception\ConfigException;

class ImgCache
{
    /**
     * @var ImgCacheService
     */
    private $imgcache;

    /**
     * ImgCache constructor.
     * @param array $config
     * @throws ConfigException
     */
    public function __construct(array $config)
    {
        $this->imgcache = new ImgCacheService($config);
    }

    /**
     * @param string $srcRelPath relative path to source image
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $absolute
     * @param bool $useStub
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function url($srcRelPath, $preset, $absolute = false, $useStub = true)
    {
        return $this->imgcache->url($srcRelPath, $preset, $absolute, $useStub);
    }

    /**
     * @param string $srcRelPath relative path to source image
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $useStub
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function path($srcRelPath, $preset, $useStub = true)
    {
        return $this->imgcache->path($srcRelPath, $preset, $useStub);
    }

    /**
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $absolute
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function stubUrl($preset, $absolute = false)
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
    public function stubPath($preset)
    {
        return $this->imgcache->stubPath($preset);
    }

    /**
     * @param string|array|null $preset preset name or dynamic preset definition
     * @throws ConfigException
     */
    public function clearCache($preset = null)
    {
        $this->imgcache->clearCache($preset);
    }
}