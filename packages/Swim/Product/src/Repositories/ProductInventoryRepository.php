<?php

namespace Swim\Product\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;

/**
 * Product Inventory Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ProductInventoryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Product\Contracts\ProductInventory';
    }

    /**
     * @param array $data
     * @param mixed $product
     * @return mixed
     */
    public function saveInventories(array $data, $product)
    {
        if (isset($data['inventories'])) {
            foreach ($data['inventories'] as $inventorySourceId => $qty) {
                $qty = is_null($qty) ? 0 : $qty;

                $productInventory = $this->findOneWhere([
                        'product_id' => $product->id,
                        'inventory_source_id' => $inventorySourceId,
                        'vendor_id' => isset($data['vendor_id']) ? $data['vendor_id'] : 0
                    ]);

                if ($productInventory) {
                    $productInventory->qty = $qty;

                    $productInventory->save();
                } else {
                    $this->create([
                            'qty' => $qty,
                            'product_id' => $product->id,
                            'inventory_source_id' => $inventorySourceId,
                            'vendor_id' => isset($data['vendor_id']) ? $data['vendor_id'] : 0
                        ]);
                }
            }
        }
    }
}