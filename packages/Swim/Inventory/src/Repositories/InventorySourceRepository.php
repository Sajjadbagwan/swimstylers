<?php

namespace Swim\Inventory\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Inventory Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class InventorySourceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Inventory\Contracts\InventorySource';
    }
}