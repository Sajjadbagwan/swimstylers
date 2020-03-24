<?php

namespace Swim\Customer\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * CustomerGroup Reposotory
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */

class CustomerGroupRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */

    function model()
    {
        return 'Swim\Customer\Contracts\CustomerGroup';
    }

    /**
     * @param array $data
     * @return mixed
     */

    public function create(array $data)
    {
        $customer = $this->model->create($data);

        return $customer;
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */

    public function update(array $data, $id, $attribute = "id")
    {
        $customer = $this->find($id);

        $customer->update($data);

        return $customer;
    }
}