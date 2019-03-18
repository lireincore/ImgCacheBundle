<?php

namespace LireinCore\ImgCacheBundle\Event;

use LireinCore\ImgCache\Event\ThumbCreatedEvent;

final class LireinCoreImgCacheEvents
{
    /**
     * Called when new thumb is created
     *
     * @Event("LireinCore\ImgCache\Event\ThumbCreatedEvent")
     */
    public const THUMB_CREATED = ThumbCreatedEvent::NAME;
}