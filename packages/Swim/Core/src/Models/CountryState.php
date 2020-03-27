<?php

namespace Swim\Core\Models;

use Swim\Core\Eloquent\TranslatableModel;
use Swim\Core\Contracts\CountryState as CountryStateContract;

class CountryState extends TranslatableModel implements CountryStateContract
{
    public $timestamps = false;

    public $translatedAttributes = ['default_name'];

    protected $with = ['translations'];

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['default_name'] = $this->default_name;

        return $array;
    }
}