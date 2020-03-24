<?php

namespace Swim\Tax\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Tax Mapping Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class TaxMapRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Tax\Contracts\TaxMap';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $taxMap = $this->model->create($data);

        return $taxMap;
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $taxMap = $this->find($id);

        $taxMap->update($data);

        return $taxMap;
    }
}