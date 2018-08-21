<?php

namespace LireinCore\ImgCacheBundle\Event;

final class LireinCoreImgCacheEvents
{
    /**
     * Called when new thumb is created
     *
     * @Event("LireinCore\ImgCacheBundle\Event\ThumbCreatedEvent")
     */
    const THUMB_CREATED = 'lireincore_imgcache.thumb_created';
}