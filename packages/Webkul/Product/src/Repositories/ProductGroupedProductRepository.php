<?php

namespace Swim\Product\Repositories;

use Swim\Core\Eloquent\Repository;
use Swim\Product\Repositories\ProductRepository;
use Illuminate\Support\Str;

/**
 * Product Grouped Product Repository
 *
 * @author Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ProductGroupedProductRepository extends Repository
{
    public function model()
    {
        return 'Swim\Product\Contracts\ProductGroupedProduct';
    }

    /**
     * @param array   $data
     * @param Product $product
     * @return void
     */
    public function saveGroupedProducts($data, $product)
    {
        $previousGroupedProductIds = $product->grouped_products()->pluck('id');

        if (isset($data['links'])) {
            foreach ($data['links'] as $linkId => $linkInputs) {
                if (Str::contains($linkId, 'link_')) {
                    $this->create(array_merge([
                            'product_id' => $product->id,
                        ], $linkInputs));
                } else {
                    if (is_numeric($index = $previousGroupedProductIds->search($linkId)))
                        $previousGroupedProductIds->forget($index);

                    $this->update($linkInputs, $linkId);
                }
            }
        }

        foreach ($previousGroupedProductIds as $previousGroupedProductId) {
            $this->delete($previousGroupedProductId);
        }
    }
}