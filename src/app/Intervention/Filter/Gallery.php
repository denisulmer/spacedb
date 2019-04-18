<?php

namespace SpaceDB\Intervention\Filter;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Gallery implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->widen(1000)->encode('jpeg', 85);
    }
}