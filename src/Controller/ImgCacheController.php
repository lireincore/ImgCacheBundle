<?php

namespace LireinCore\ImgCacheBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use LireinCore\ImgCacheBundle\Service\ImgCacheInterface;

class ImgCacheController extends AbstractController
{
    /**
     * @Route("/imgcache")
     */
    public function image(ImgCacheInterface $imgCache)
    {
        return '';
    }
}