<?php

namespace Swim\Core\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Country Reposotory
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CountryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Core\Contracts\Country';
    }
}