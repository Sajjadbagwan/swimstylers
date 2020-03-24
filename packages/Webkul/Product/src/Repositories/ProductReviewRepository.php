<?php

namespace Swim\Product\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;

/**
 * Product Review Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ProductReviewRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Product\Contracts\ProductReview';
    }

    /**
     * Retrieve review for customerId
     *
     * @param int $customerId
     */
    function getCustomerReview()
    {
        $customerId = auth()->guard('customer')->user()->id;

        $reviews = $this->model->where(['customer_id'=> $customerId])->with('product')->paginate(5);

        return $reviews;
    }
}