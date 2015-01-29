<?php

namespace Avalanche\Bundle\ImagineBundle\Templating;

use Avalanche\Bundle\ImagineBundle\Imagine\CachePathResolver;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class ImagineExtension extends Twig_Extension
{
    /**
     * @var CachePathResolver
     */
    private $cachePathResolver;

    public function __construct(CachePathResolver $cachePathResolver)
    {
        $this->cachePathResolver = $cachePathResolver;
    }

    /**
     * (non-PHPdoc)
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('apply_filter', [$this, 'applyFilter']),
        ];
    }

    /**
     * {non-PHPdoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('filter', [$this, 'applyFilter']),
        ];
    }

    /**
     * Gets cache path of an image to be filtered
     *
     * @param string  $path
     * @param string  $filter
     * @param boolean $absolute
     *
     * @return string
     */
    public function applyFilter($path, $filter, $absolute = false)
    {
        return $this->cachePathResolver->getBrowserPath($path, $filter, $absolute);
    }

    /**
     * (non-PHPdoc)
     */
    public function getName()
    {
        return 'imagine';
    }
}
