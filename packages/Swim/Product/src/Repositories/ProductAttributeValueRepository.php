<?php

namespace Swim\Product\Repositories;

use Illuminate\Container\Container as App;
use Swim\Attribute\Repositories\AttributeRepository;
use Swim\Core\Eloquent\Repository;
use Swim\Product\Models\ProductAttributeValue;

/**
 * Product Attribute Value Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ProductAttributeValueRepository extends Repository
{
    /**
     * AttributeRepository object
     *
     * @var array
     */
    protected $attributeRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Swim\Attribute\Repositories\AttributeRepository $attributeRepository
     * @return void
     */
    public function __construct(
        AttributeRepository $attributeRepository,
        App $app
    )
    {
        $this->attributeRepository = $attributeRepository;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Product\Contracts\ProductAttributeValue';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        if (isset($data['attribute_id'])) {
            $attribute = $this->attributeRepository->find($data['attribute_id']);
        } else {
            $attribute = $this->attributeRepository->findOneByField('code', $data['attribute_code']);
        }

        if (! $attribute)
            return;

        $data[ProductAttributeValue::$attributeTypeFields[$attribute->type]] = $data['value'];

        return $this->model->create($data);
    }

    /**
     * @param string $column
     * @param int    $attributeId
     * @param int    $productId
     * @param string $value
     * @return boolean
     */
    public function isValueUnique($productId, $attributeId, $column, $value)
    {
        $result = $this->resetScope()->model->where($column, $value)->where('attribute_id', '=', $attributeId)->where('product_id', '!=', $productId)->get();

        return $result->count() ? false : true;
    }
}