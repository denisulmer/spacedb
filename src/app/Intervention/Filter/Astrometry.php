<?php

namespace SpaceDB\Intervention\Filter;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Astrometry implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->widen(3000, function ($constraint) {
            $constraint->upsize();
        });
    }
}