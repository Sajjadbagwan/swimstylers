<?php

namespace Swim\Product\CacheFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(480, null, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}