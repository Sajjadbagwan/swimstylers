<?php

namespace Swim\Checkout\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Cart Items Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */

class CartItemRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */

    function model()
    {
        return 'Swim\Checkout\Contracts\CartItem';
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */

    public function update(array $data, $id, $attribute = "id")
    {
        $item = $this->find($id);

        $item->update($data);

        return $item;
    }

    public function getProduct($cartItemId)
    {
        return $this->model->find($cartItemId)->product->id;
    }
}