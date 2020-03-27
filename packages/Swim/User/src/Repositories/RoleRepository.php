<?php

namespace Swim\User\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Role Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class RoleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\User\Contracts\Role';
    }
}