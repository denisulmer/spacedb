<?php

namespace SpaceDB\Intervention\Filter;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Grid implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->heighten(200)->encode('jpeg', 70);
    }
}