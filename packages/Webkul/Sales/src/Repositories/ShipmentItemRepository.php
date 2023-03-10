<?php

namespace Swim\Sales\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Event;
use Swim\Sales\Contracts\ShipmentItem;

/**
 * ShipmentItem Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ShipmentItemRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return Mixed
     */
    function model()
    {
        return ShipmentItem::class;
    }

    /**
     * @param array $data
     * @return void
     */
    public function updateProductInventory($data)
    {
        if (! $data['product'])
            return;

        $orderedInventory = $data['product']->ordered_inventories()
                ->where('channel_id', $data['shipment']->order->channel->id)
                ->first();

        if ($orderedInventory) {
            if (($orderedQty = $orderedInventory->qty - $data['qty']) < 0)
                $orderedQty = 0;

            $orderedInventory->update(['qty' => $orderedQty]);
        }

        $inventory = $data['product']->inventories()
                ->where('vendor_id', $data['vendor_id'])
                ->where('inventory_source_id', $data['shipment']->inventory_source_id)
                ->first();

        if (! $inventory)
            return;

        if (($qty = $inventory->qty - $data['qty']) < 0)
            $qty = 0;

        $inventory->update(['qty' => $qty]);

        Event::dispatch('catalog.product.update.after', $data['product']);
    }
}