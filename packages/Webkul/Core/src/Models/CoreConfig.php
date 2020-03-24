<?php

namespace Swim\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Core\Contracts\CoreConfig as CoreConfigContract;

class CoreConfig extends Model implements CoreConfigContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'core_config';

    protected $fillable = [
        'code', 'value','channel_code','locale_code'
    ];

    protected $hidden = ['token'];
}