<?php

namespace Swim\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Swim\Inventory\Models\InventorySource;
use Swim\Core\Models\ChannelProxy;
use Swim\Product\Contracts\ProductSalableInventory as ProductSalableInventoryContract;

class ProductSalableInventory extends Model implements ProductSalableInventoryContract
{
    public $timestamps = false;

    protected $fillable = ['qty', 'sold_qty', 'product_id', 'channel_id'];

    /**
     * Get the channel owns the inventory.
     */
    public function channel()
    {
        return $this->belongsTo(ChannelProxy::modelClass());
    }

    // /**
    //  * Get the inventory source owns the product.
    //  */
    // public function inventory_source()
    // {
    //     return $this->belongsTo(InventorySource::class);
    // }

    /**
     * Get the product that owns the product inventory.
     */
    public function product()
    {
        return $this->belongsTo(ProductProxy::modelClass());
    }
}