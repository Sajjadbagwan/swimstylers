<?php

namespace Swim\Core\Models;

use Swim\Core\Eloquent\TranslatableModel;
use Swim\Core\Contracts\Country as CountryContract;

class Country extends TranslatableModel implements CountryContract
{
    public $timestamps = false;

    public $translatedAttributes = ['name'];

    protected $with = ['translations'];
}