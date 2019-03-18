# Image effect, thumb and cache bundle for Symfony

[![Build Status](https://secure.travis-ci.org/lireincore/LireinCoreImgCacheBundle.png?branch=master)](http://travis-ci.org/lireincore/LireinCoreImgCacheBundle)
[![Latest Stable Version](https://poser.pugx.org/lireincore/imgcache-bundle/v/stable)](https://packagist.org/packages/lireincore/imgcache-bundle)
[![Total Downloads](https://poser.pugx.org/lireincore/imgcache-bundle/downloads)](https://packagist.org/packages/lireincore/imgcache-bundle)
[![License](https://poser.pugx.org/lireincore/imgcache-bundle/license)](https://packagist.org/packages/lireincore/imgcache-bundle)

## About

The [lireincore/imgcache](https://github.com/lireincore/imgcache) integration for Symfony framework.

## Install

Add the `"lireincore/imgcache-bundle": "^0.2"` package to your `require` section in the `composer.json` file

or

``` bash
$ php composer.phar require lireincore/imgcache-bundle
```

## Usage

To use this bundle, you need to create the `lireincore_imgcache.yaml` file in your `config/packages` folder and paste this boilerplate:

```yaml
# config/packages/lireincore_imgcache.yaml

lireincore_imgcache:
    srcdir: '%kernel.project_dir%/files'
    destdir: '%kernel.project_dir%/public/thumbs'
    webdir: '%kernel.project_dir%/public'
    presets:
        origin:
            effects:
                - { type: 'resize', params: { width: '50%', height: 100 } }
                - 'grayscale'
```

See `lireincore/imgcache` [README.md](https://github.com/lireincore/imgcache/blob/master/README.md) for more information about the available effects and other config options.

Use in your code:

```php
$imgcache = $this->container->get('lireincore_imgcache.service.imgcache');
//get thumb url for image '{srcdir}/blog/image.jpg' (preset 'origin')
$url = $imgcache->url('blog/image.jpg', 'origin');
```

See `lireincore/imgcache` [README.md](https://github.com/lireincore/imgcache/blob/master/README.md) for more information about the available functions.

## License

This project is licensed under the MIT License - see the [License File](LICENSE) file for details
