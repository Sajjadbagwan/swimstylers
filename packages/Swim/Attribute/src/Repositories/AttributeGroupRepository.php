<?php

namespace Swim\Attribute\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Attribute Group Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class AttributeGroupRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Attribute\Contracts\AttributeGroup';
    }
}