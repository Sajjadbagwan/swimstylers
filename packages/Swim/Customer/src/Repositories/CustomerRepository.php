<?php

namespace Swim\Customer\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Customer Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CustomerRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */

    function model()
    {
        return 'Swim\Customer\Contracts\Customer';
    }
}