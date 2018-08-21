<?php

namespace LireinCore\ImgCacheBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ThumbCreatedEvent extends Event
{
    /**
     * @var array
     */
    private $data;

    /**
     * ThumbCreatedEvent constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}