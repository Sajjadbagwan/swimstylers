<?php

namespace Swim\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Product\Contracts\ProductDownloadableLinkTranslation as ProductDownloadableLinkTranslationContract;

class ProductDownloadableLinkTranslation extends Model implements ProductDownloadableLinkTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['title'];
}