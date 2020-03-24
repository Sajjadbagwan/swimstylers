<?php

namespace Swim\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Product\Contracts\ProductBundleOptionTranslation as ProductBundleOptionTranslationContract;

class ProductBundleOptionTranslation extends Model implements ProductBundleOptionTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['label'];
}