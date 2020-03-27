<?php

namespace Swim\Product\Helpers;

use Swim\Attribute\Repositories\AttributeOptionRepository as AttributeOption;
use Swim\Product\Models\Product;
use Swim\Product\Models\ProductAttributeValue;

/**
 * Configurable Option Helper
 *
 * @author Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ConfigurableOption extends AbstractProduct
{
    /**
     * AttributeOptionRepository object
     *
     * @var array
     */
    protected $attributeOption;

    /**
     * ProductImage object
     *
     * @var array
     */
    protected $productImage;

    /**
     * Create a new controller instance.
     *
     * @param  Swim\Attribute\Repositories\AttributeOptionRepository $attributeOption
     * @param  Swim\Product\Helpers\ProductImage                     $productImage
     * @return void
     */
    public function __construct(
        AttributeOption $attributeOption,
        ProductImage $productImage
    )
    {
        $this->attributeOption = $attributeOption;

        $this->productImage = $productImage;
    }

    /**
     * Returns the allowed variants
     *
     * @param Product $product
     * @return float
     */
    public function getAllowedProducts($product)
    {
        static $variants = [];

        if (count($variants))
            return $variants;

        foreach ($product->variants as $variant) {
            if ($variant->isSaleable()) {
                $variants[] = $variant;
            }
        }

        return $variants;
    }

    /**
     * Returns the allowed variants JSON
     *
     * @param Product $product
     * @return array
     */
    public function getConfigurationConfig($product)
    {
        $options = $this->getOptions($product, $this->getAllowedProducts($product));

        $config = [
            'attributes' => $this->getAttributesData($product, $options),
            'index' => isset($options['index']) ? $options['index'] : [],
            'regular_price' => [
                'formated_price' => core()->currency($product->getTypeInstance()->getMinimalPrice()),
                'price' => $product->getTypeInstance()->getMinimalPrice()
            ],
            'variant_prices' => $this->getVariantPrices($product),
            'variant_images' => $this->getVariantImages($product),
            'chooseText' => trans('shop::app.products.choose-option')
        ];

        return $config;
    }

    /**
     * Get allowed attributes
     *
     * @param Product $product
     * @return array
     */
    public function getAllowAttributes($product)
    {
        return $product->product->super_attributes;
    }

    /**
     * Get Configurable Product Options
     *
     * @param Product $currentProduct
     * @param array $allowedProducts
     * @return array
     */
    public function getOptions($currentProduct, $allowedProducts)
    {
        $options = [];

        $allowAttributes = $this->getAllowAttributes($currentProduct);

        foreach ($allowedProducts as $product) {
            if ($product instanceof \Swim\Product\Models\ProductFlat) {
                $productId = $product->product_id;
            } else {
                $productId = $product->id;
            }

            foreach ($allowAttributes as $productAttribute) {
                $productAttributeId = $productAttribute->id;

                $attributeValue = $product->{$productAttribute->code};

                if ($attributeValue == '' && $product instanceof \Swim\Product\Models\ProductFlat)
                    $attributeValue = $product->product->{$productAttribute->code};

                $options[$productAttributeId][$attributeValue][] = $productId;

                $options['index'][$productId][$productAttributeId] = $attributeValue;
            }
        }

        return $options;
    }

    /**
     * Get product attributes
     *
     * @param Product $product
     * @param array $options
     * @return array
     */
    public function getAttributesData($product, array $options = [])
    {
        $defaultValues = [];

        $attributes = [];

        $allowAttributes = $this->getAllowAttributes($product);

        foreach ($allowAttributes as $attribute) {

            $attributeOptionsData = $this->getAttributeOptionsData($attribute, $options);

            if ($attributeOptionsData) {
                $attributeId = $attribute->id;

                $attributes[] = [
                    'id' => $attributeId,
                    'code' => $attribute->code,
                    'label' => $attribute->name ? $attribute->name : $attribute->admin_name,
                    'swatch_type' => $attribute->swatch_type,
                    'options' => $attributeOptionsData
                ];
            }
        }

        return $attributes;
    }

    /**
     * @param Attribute $attribute
     * @param array $options
     * @return array
     */
    protected function getAttributeOptionsData($attribute, $options)
    {
        $attributeOptionsData = [];

        foreach ($attribute->options as $attributeOption) {

            $optionId = $attributeOption->id;

            if (isset($options[$attribute->id][$optionId])) {
                $attributeOptionsData[] = [
                    'id' => $optionId,
                    'label' => $attributeOption->label ? $attributeOption->label : $attributeOption->admin_name,
                    'swatch_value' => $attribute->swatch_type == 'image' ? $attributeOption->swatch_value_url : $attributeOption->swatch_value,
                    'products' => $options[$attribute->id][$optionId]
                ];
            }
        }

        return $attributeOptionsData;
    }

    /**
     * Get product prices for configurable variations
     *
     * @param Product $product
     * @return array
     */
    protected function getVariantPrices($product)
    {
        $prices = [];

        foreach ($this->getAllowedProducts($product) as $variant) {
            if ($variant instanceof \Swim\Product\Models\ProductFlat) {
                $variantId = $variant->product_id;
            } else {
                $variantId = $variant->id;
            }

            $prices[$variantId] = $variant->getTypeInstance()->getProductPrices();
        }

        return $prices;
    }

    /**
     * Get product images for configurable variations
     *
     * @param Product $product
     * @return array
     */
    protected function getVariantImages($product)
    {
        $images = [];

        foreach ($this->getAllowedProducts($product) as $variant) {
            if ($variant instanceof \Swim\Product\Models\ProductFlat) {
                $variantId = $variant->product_id;
            } else {
                $variantId = $variant->id;
            }

            $images[$variantId] = $this->productImage->getGalleryImages($variant);
        }

        return $images;
    }
}