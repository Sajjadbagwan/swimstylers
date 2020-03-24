<?php

namespace Swim\Velocity\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * ContentTranslation Reposotory
 *
 * @author    Vivek Sharma <viveksh047@Swim.com>
 * @copyright 2019 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ContentTranslationRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Velocity\Models\ContentTranslation';
    }
}