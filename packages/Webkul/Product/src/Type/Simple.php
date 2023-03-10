<?php

namespace Swim\Product\Type;

/**
 * Class Simple.
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class Simple extends AbstractType
{
    /**
     * Skip attribute for simple product type
     *
     * @var array
     */
    protected $skipAttributes = [];

    /**
     * These blade files will be included in product edit page
     *
     * @var array
     */
    protected $additionalViews = [
        'admin::catalog.products.accordians.inventories',
        'admin::catalog.products.accordians.images',
        'admin::catalog.products.accordians.categories',
        'admin::catalog.products.accordians.channels',
        'admin::catalog.products.accordians.product-links',
    ];

    /**
     * Show quantity box
     *
     * @var boolean
     */
    protected $showQuantityBox = true;

    /**
     * Return true if this product type is saleable
     *
     * @return boolean
     */
    public function isSaleable()
    {
        if (! $this->product->status)
            return false;

        if ($this->haveSufficientQuantity(1))
            return true;

        return false;
    }

    /**
     * @param integer $qty
     *
     * @return boolean
     */
    public function haveSufficientQuantity($qty)
    {
        $backorders = core()->getConfigData('catalog.inventory.stock_options.backorders');
        return $qty <= $this->totalQuantity() ? true : $backorders;
    }
}