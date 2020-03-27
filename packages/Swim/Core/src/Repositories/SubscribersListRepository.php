<?php

namespace Swim\Core\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;

/**
 * SubscribersList Repository
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class SubscribersListRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Core\Contracts\SubscribersList';
    }


    /**
     * Delete a slider item and delete the image from the disk or where ever it is
     *
     * @return Boolean
     */
    public function destroy($id) {
        return $this->model->destroy($id);
    }
}