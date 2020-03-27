<?php

namespace Swim\Checkout\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Cart Address Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */

class CartAddressRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return Mixed
     */
    function model()
    {
        return 'Swim\Checkout\Contracts\CartAddress';
    }
}