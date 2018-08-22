<?php

namespace LireinCore\ImgCacheBundle;

use LireinCore\ImgCacheBundle\DependencyInjection\LireinCoreImgCacheExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LireinCoreImgCacheBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new LireinCoreImgCacheExtension();
        }

        return $this->extension;
    }
}