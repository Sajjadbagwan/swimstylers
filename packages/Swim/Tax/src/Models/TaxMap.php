<?php

namespace Swim\Tax\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Tax\Models\TaxCategory;
use Swim\Tax\Models\TaxRate;
use Swim\Tax\Contracts\TaxMap as TaxMapContract;

class TaxMap extends Model implements TaxMapContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tax_categories_tax_rates';

    protected $fillable = [
       'tax_category_id', 'tax_rate_id'
    ];

}