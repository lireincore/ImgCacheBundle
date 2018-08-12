<?php

namespace LireinCore\ImgCacheBundle\Service;

use LireinCore\ImgCache\Exception\ConfigException;

interface ImgCacheInterface
{
    public const TAG = 'imgcache.service';

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
    public function url($srcRelPath, $preset, $absolute = false, $useStub = true);
    /**
     * @param string $srcRelPath relative path to source image
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $useStub
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function path($srcRelPath, $preset, $useStub = true);

    /**
     * @param string|array $preset preset name or dynamic preset definition
     * @param bool $absolute
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function stubUrl($preset, $absolute = false);

    /**
     * @param string|array $preset preset name or dynamic preset definition
     * @return string
     * @throws ConfigException
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function stubPath($preset);

    /**
     * @param string|array|null $preset preset name or dynamic preset definition
     * @throws ConfigException
     */
    public function clearCache($preset = null);
}