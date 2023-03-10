<?php

namespace Swim\Product\Type;

use Swim\Attribute\Repositories\AttributeRepository;
use Swim\Product\Repositories\ProductRepository;
use Swim\Product\Repositories\ProductAttributeValueRepository;
use Swim\Product\Repositories\ProductInventoryRepository;
use Swim\Product\Repositories\ProductImageRepository;
use Swim\Product\Repositories\ProductGroupedProductRepository;
use Swim\Product\Helpers\ProductImage;
use Swim\Product\Models\ProductAttributeValue;
use Swim\Product\Models\ProductFlat;

/**
 * Class Grouped.
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class Grouped extends AbstractType
{
    /**
     * ProductGroupedProductRepository instance
     *
     * @var ProductGroupedProductRepository
     */
    protected $productGroupedProductRepository;
    
    /**
     * Skip attribute for downloadable product type
     *
     * @var array
     */
    protected $skipAttributes = ['price', 'cost', 'special_price', 'special_price_from', 'special_price_to', 'width', 'height', 'depth', 'weight'];

    /**
     * These blade files will be included in product edit page
     * 
     * @var array
     */
    protected $additionalViews = [
        'admin::catalog.products.accordians.images',
        'admin::catalog.products.accordians.categories',
        'admin::catalog.products.accordians.grouped-products',
        'admin::catalog.products.accordians.channels',
        'admin::catalog.products.accordians.product-links'
    ];

    /**
     * Is a composite product type
     *
     * @var boolean
     */
    protected $isComposite = true;

    /**
     * Create a new product type instance.
     *
     * @param  Swim\Attribute\Repositories\AttributeRepository           $attributeRepository
     * @param  Swim\Product\Repositories\ProductRepository               $productRepository
     * @param  Swim\Product\Repositories\ProductAttributeValueRepository $attributeValueRepository
     * @param  Swim\Product\Repositories\ProductInventoryRepository      $productInventoryRepository
     * @param  Swim\Product\Repositories\ProductImageRepository          $productImageRepository
     * @param  Swim\Product\Repositories\ProductGroupedProductRepository $productGroupedProductRepository
     * @param  Swim\Product\Helpers\ProductImage                         $productImageHelper
     * @return void
     */
    public function __construct(
        AttributeRepository $attributeRepository,
        ProductRepository $productRepository,
        ProductAttributeValueRepository $attributeValueRepository,
        ProductInventoryRepository $productInventoryRepository,
        ProductImageRepository $productImageRepository,
        ProductGroupedProductRepository $productGroupedProductRepository,
        ProductImage $productImageHelper
    )
    {
        parent::__construct(
            $attributeRepository,
            $productRepository,
            $attributeValueRepository,
            $productInventoryRepository,
            $productImageRepository,
            $productImageHelper
        );

        $this->productGroupedProductRepository = $productGroupedProductRepository;
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return Product
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $product = parent::update($data, $id, $attribute);

        if (request()->route()->getName() != 'admin.catalog.products.massupdate')
            $this->productGroupedProductRepository->saveGroupedProducts($data, $product);

        return $product;
    }

    /**
     * Returns children ids
     *
     * @return array
     */
    public function getChildrenIds()
    {
        return array_unique($this->product->grouped_products()->pluck('product_id')->toArray());
    }

    /**
     * Check if catalog rule can be applied
     *
     * @return bool
     */
    public function priceRuleCanBeApplied()
    {
        return false;
    }

    /**
     * Get product minimal price
     *
     * @return float
     */
    public function getMinimalPrice()
    {
        $minPrices = [];

        foreach ($this->product->grouped_products as $groupOptionProduct) {
            $minPrices[] = $groupOptionProduct->associated_product->getTypeInstance()->getMinimalPrice();
        }

        if (empty($minPrices))
            return 0;

        return min($minPrices);
    }

    /**
     * Get product minimal price
     *
     * @return string
     */
    public function getPriceHtml()
    {
        return '<span class="price-label">' . trans('shop::app.products.starting-at') . '</span>'
            . '<span class="final-price">' . core()->currency($this->getMinimalPrice()) . '</span>';
    }

    /**
     * Add product. Returns error message if can't prepare product.
     *
     * @param array $data
     * @return array
     */
    public function prepareForCart($data)
    {
        if (! isset($data['qty']) || ! is_array($data['qty']))
            return trans('shop::app.checkout.cart.integrity.missing_options');

        $products = [];

        foreach ($data['qty'] as $productId => $qty) {
            if (! $qty)
                continue;

            $product = $this->productRepository->find($productId);

            $cartProducts = $product->getTypeInstance()->prepareForCart([
                    'product_id' => $productId,
                    'quantity' => $qty,
                ]);

            if (is_string($cartProducts))
                return $cartProducts;
                
            $products = array_merge($products, $cartProducts);
        }

        if (! count($products))
            return trans('shop::app.checkout.cart.integrity.qty_missing');

        return $products;
    }
}