<?php

namespace Swim\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Inventory\Contracts\InventorySource as InventorySourceContract;

class InventorySource extends Model implements InventorySourceContract
{
    protected $guarded = ['_token'];
}