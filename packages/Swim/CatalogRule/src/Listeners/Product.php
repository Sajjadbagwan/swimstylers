<?php

namespace Swim\CatalogRule\Listeners;

use Swim\CatalogRule\Helpers\CatalogRuleIndex;

/**
 * Products Event handler
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class Product
{
    /**
     * Product Repository Object
     * 
     * @var Object
     */
    protected $catalogRuleIndexHelper;

    /**
     * Create a new listener instance.
     * 
     * @param  Swim\CatalogRule\Helpers\CatalogRuleIndex $catalogRuleIndexHelper
     * @return void
     */
    public function __construct(CatalogRuleIndex $catalogRuleIndexHelper)
    {
        $this->catalogRuleIndexHelper = $catalogRuleIndexHelper;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function createProductRuleIndex($product)
    {
        $this->catalogRuleIndexHelper->reindexProduct($product);
    }
}