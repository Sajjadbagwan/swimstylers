<?php

namespace Swim\Velocity\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;

/**
 * OrderBrands Reposotory
 *
 * @copyright 2019 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class OrderBrandsRepository extends Repository
{   

    /**
     * Create a new controller instance.
     *
     * @param  Swim\OrderBrands\Repositories\OrderBrandsRepository $OrderBrands
     * @return void
     */
    public function __construct(
        App $app
        )
    {
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Velocity\Models\OrderBrands';
    }
    
}