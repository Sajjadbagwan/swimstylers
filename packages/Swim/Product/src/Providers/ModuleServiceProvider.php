<?php

namespace Swim\Product\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Swim\Product\Models\Product::class,
        \Swim\Product\Models\ProductAttributeValue::class,
        \Swim\Product\Models\ProductFlat::class,
        \Swim\Product\Models\ProductImage::class,
        \Swim\Product\Models\ProductInventory::class,
        \Swim\Product\Models\ProductOrderedInventory::class,
        \Swim\Product\Models\ProductReview::class,
        \Swim\Product\Models\ProductSalableInventory::class,
        \Swim\Product\Models\ProductDownloadableSample::class,
        \Swim\Product\Models\ProductDownloadableLink::class,
        \Swim\Product\Models\ProductGroupedProduct::class,
        \Swim\Product\Models\ProductBundleOption::class,
        \Swim\Product\Models\ProductBundleOptionTranslation::class,
        \Swim\Product\Models\ProductBundleOptionProduct::class,
    ];
}