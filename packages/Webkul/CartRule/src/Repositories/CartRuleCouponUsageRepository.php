<?php

namespace Swim\CartRule\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * CartRuleCouponUsage Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CartRuleCouponUsageRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\CartRule\Contracts\CartRuleCouponUsage';
    }
}