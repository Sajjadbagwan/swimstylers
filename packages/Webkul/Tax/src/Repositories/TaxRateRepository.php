<?php

namespace Swim\Tax\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Tax Rate Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class TaxRateRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Tax\Contracts\TaxRate';
    }
}