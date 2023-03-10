<?php

namespace Swim\Product\Helpers;

use Swim\Product\Models\ProductAttributeValue;
use Swim\Product\Models\ProductFlatProxy;
use Swim\Product\Models\ProductFlat;

/**
 * Abstract Product Helper
 *
 * @author Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
abstract class AbstractProduct
{
    /**
     * array
     *
     * @var array
     */
    protected $productFlat = [];

    /**
     * Add Channle and Locale filter
     *
     * @param Attribute $attribute
     * @param QB $qb
     * @param sting $alias
     * @return QB
     */
    public function applyChannelLocaleFilter($attribute, $qb, $alias = 'product_attribute_values')
    {
        $channel = request()->get('channel') ?: (core()->getCurrentChannelCode() ?: core()->getDefaultChannelCode());

        $locale = request()->get('locale') ?: app()->getLocale();

        if ($attribute->value_per_channel) {
            if ($attribute->value_per_locale) {
                $qb->where($alias . '.channel', $channel)
                    ->where($alias . '.locale', $locale);
            } else {
                $qb->where($alias . '.channel', $channel);
            }
        } else {
            if ($attribute->value_per_locale) {
                $qb->where($alias . '.locale', $locale);
            }
        }

        return $qb;
    }

    /**
     * Sets product flat variable
     *
     * @param Product $product
     * @return void
     */
    public function setProductFlat($product)
    {
        if (array_key_exists($product->id, $this->productFlat))
            return;

        if (! $product instanceof ProductFlat) {
            $this->productFlat[$product->id] = ProductFlatProxy::modelClass()
                ::where('product_flat.product_id', $product->id)
                ->where('product_flat.locale', app()->getLocale())
                ->where('product_flat.channel', core()->getCurrentChannelCode())
                ->select('product_flat.*')
                ->first();
        } else {
            $this->productFlat[$product->id] = $product;
        }
    }
}