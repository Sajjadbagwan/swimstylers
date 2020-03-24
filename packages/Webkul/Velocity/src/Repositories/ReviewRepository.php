<?php

namespace Swim\Velocity\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;
use Swim\Product\Repositories\ProductRepository;

/**
 * Review Reposotory
 *
 * @copyright 2019 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ReviewRepository extends Repository
{
    /**
     * ProductImageRepository object
     *
     * @var array
     */
    protected $product;

    /**
     * Create a new controller instance.
     *
     * @param  Swim\Product\Repositories\ProductRepository      $product
     * @return void
     */
    public function __construct(
        ProductRepository $product,
        App $app)
    {
        $this->product = $product;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\Product\Contracts\ProductReview';
    }


    function getAll() 
    {
        $reviews = $this->model->get();
        
        return $reviews;
    }
}