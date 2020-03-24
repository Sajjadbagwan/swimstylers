<?php

namespace Swim\CatalogRule\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * CatalogRuleProductPrice Repository
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CatalogRuleProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\CatalogRule\Contracts\CatalogRuleProduct';
    }
}