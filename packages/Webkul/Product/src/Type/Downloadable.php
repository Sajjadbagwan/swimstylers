<?php

namespace Swim\Product\Type;

use Swim\Attribute\Repositories\AttributeRepository;
use Swim\Product\Repositories\ProductRepository;
use Swim\Product\Repositories\ProductAttributeValueRepository;
use Swim\Product\Repositories\ProductInventoryRepository;
use Swim\Product\Repositories\ProductImageRepository;
use Swim\Product\Repositories\ProductDownloadableLinkRepository;
use Swim\Product\Repositories\ProductDownloadableSampleRepository;
use Swim\Product\Helpers\ProductImage;
use Swim\Checkout\Models\CartItem;

/**
 * Class Downloadable.
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class Downloadable extends AbstractType
{
    /**
     * ProductDownloadableLinkRepository instance
     *
     * @var ProductDownloadableLinkRepository
    */
    protected $productDownloadableLinkRepository;

    /**
     * ProductDownloadableSampleRepository instance
     *
     * @var ProductDownloadableSampleRepository
    */
    protected $productDownloadableSampleRepository;

    /**
     * Skip attribute for downloadable product type
     *
     * @var array
     */
    protected $skipAttributes = ['width', 'height', 'depth', 'weight', 'guest_checkout'];

    /**
     * These blade files will be included in product edit page
     *
     * @var array
     */
    protected $additionalViews = [
        'admin::catalog.products.accordians.images',
        'admin::catalog.products.accordians.categories',
        'admin::catalog.products.accordians.downloadable',
        'admin::catalog.products.accordians.channels',
        'admin::catalog.products.accordians.product-links'
    ];

    /**
     * Is a stokable product type
     *
     * @var boolean
     */
    protected $isStockable = false;

    /**
     * Create a new product type instance.
     *
     * @param  Swim\Attribute\Repositories\AttributeRepository               $attributeRepository
     * @param  Swim\Product\Repositories\ProductRepository                   $productRepository
     * @param  Swim\Product\Repositories\ProductAttributeValueRepository     $attributeValueRepository
     * @param  Swim\Product\Repositories\ProductInventoryRepository          $productInventoryRepository
     * @param  Swim\Product\Repositories\ProductImageRepository              $productImageRepository
     * @param  Swim\Product\Repositories\ProductDownloadableLinkRepository   $productDownloadableLinkRepository
     * @param  Swim\Product\Repositories\ProductDownloadableSampleRepository $productDownloadableSampleRepository
     * @param  Swim\Product\Helpers\ProductImage                             $productImageHelper
     * @return void
     */
    public function __construct(
        AttributeRepository $attributeRepository,
        ProductRepository $productRepository,
        ProductAttributeValueRepository $attributeValueRepository,
        ProductInventoryRepository $productInventoryRepository,
        productImageRepository $productImageRepository,
        ProductDownloadableLinkRepository $productDownloadableLinkRepository,
        ProductDownloadableSampleRepository $productDownloadableSampleRepository,
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

        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

        $this->productDownloadableSampleRepository = $productDownloadableSampleRepository;
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

        if (request()->route()->getName() != 'admin.catalog.products.massupdate') {
            $this->productDownloadableLinkRepository->saveLinks($data, $product);

            $this->productDownloadableSampleRepository->saveSamples($data, $product);
        }

        return $product;
    }

    /**
     * Return true if this product type is saleable
     *
     * @return boolean
     */
    public function isSaleable()
    {
        if (! $this->product->status)
            return false;

        if ($this->product->downloadable_links()->count())
            return true;

        return false;
    }

    /**
     * Returns validation rules
     *
     * @return array
     */
    public function getTypeValidationRules()
    {
        return [
            // 'downloadable_links.*.title' => 'required',
            'downloadable_links.*.type' => 'required',
            'downloadable_links.*.file' => 'required_if:type,==,file',
            'downloadable_links.*.file_name' => 'required_if:type,==,file',
            'downloadable_links.*.url' => 'required_if:type,==,url',
            'downloadable_links.*.downloads' => 'required',
            'downloadable_links.*.sort_order' => 'required',
        ];
    }

    /**
     * Add product. Returns error message if can't prepare product.
     *
     * @param array   $data
     * @return array
     */
    public function prepareForCart($data)
    {
        if (! isset($data['links']) || ! count($data['links']))
            return trans('shop::app.checkout.cart.integrity.missing_links');

        $products = parent::prepareForCart($data);

        foreach ($this->product->downloadable_links as $link) {
            if (! in_array($link->id, $data['links']))
                continue;

            $products[0]['price'] += core()->convertPrice($link->price);
            $products[0]['base_price'] += $link->price;
            $products[0]['total'] += (core()->convertPrice($link->price) * $products[0]['quantity']);
            $products[0]['base_total'] += ($link->price * $products[0]['quantity']);
        }

        return $products;
    }

    /**
     *
     * @param array $options1
     * @param array $options2
     * @return boolean
     */
    public function compareOptions($options1, $options2)
    {
        if ($this->product->id != $options2['product_id'])
            return false;

        return $options1['links'] == $options2['links'];
    }

    /**
     * Returns additional information for items
     *
     * @param array $data
     * @return array
     */
    public function getAdditionalOptions($data)
    {
        $labels = [];

        foreach ($this->product->downloadable_links as $link) {
            if (in_array($link->id, $data['links']))
                $labels[] = $link->title;
        }

        $data['attributes'][0] = [
            'attribute_name' => 'Downloads',
            'option_id' => 0,
            'option_label' => implode(', ', $labels),
        ];

        return $data;
    }

    /**
     * Validate cart item product price
     *
     * @param CartItem $item
     * @return float
     */
    public function validateCartItem($item)
    {
        $price = $item->product->getTypeInstance()->getFinalPrice();

        foreach ($item->product->downloadable_links as $link) {
            if (! in_array($link->id, $item->additional['links']))
                continue;

            $price += $link->price;
        }

        if ($price == $item->base_price)
            return;

        $item->base_price = $price;
        $item->price = core()->convertPrice($price);

        $item->base_total = $price * $item->quantity;
        $item->total = core()->convertPrice($price * $item->quantity);

        $item->save();
    }
}