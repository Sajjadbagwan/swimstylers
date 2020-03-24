<?php

namespace Swim\Classes\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Classes\Contracts\CategoryTranslation as ClassesTranslationContract;

/**
 * Class CategoryTranslation
 *
 * @package Swim\Category\Models
 *
 * @property-read string $url_path maintained by database triggers
 */
class ClassesTranslation extends Model implements ClassesTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'locale_id'];
}