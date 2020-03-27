<?php

namespace Swim\Tax\Repositories;

use Swim\Core\Eloquent\Repository;

/**
 * Tax Category Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class TaxCategoryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Tax\Contracts\TaxCategory';
    }

    public function attachOrDetach($taxCategory, $data)
    {
        $taxRates = $taxCategory->tax_rates;

        $this->model->findOrFail($taxCategory->id)->tax_rates()->sync($data);

        return true;
    }
}