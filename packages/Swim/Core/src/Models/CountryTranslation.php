<?php

namespace Swim\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Core\Contracts\CountryTranslation as CountryTranslationContract;

class CountryTranslation extends Model implements CountryTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['name'];
}