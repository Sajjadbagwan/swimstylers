<?php

namespace Swim\Sales\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;
use Swim\Sales\Contracts\OrderAddress;

/**
 * Order Address Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */

class OrderAddressRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return Mixed
     */

    function model()
    {
        return OrderAddress::class;
    }
}