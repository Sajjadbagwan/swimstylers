<?php

namespace Swim\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Core\Contracts\CurrencyExchangeRate as CurrencyExchangeRateContract;

class CurrencyExchangeRate extends Model implements CurrencyExchangeRateContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'target_currency', 'rate'
    ];
}