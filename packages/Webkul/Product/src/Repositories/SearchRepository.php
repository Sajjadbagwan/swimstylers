<?php

namespace Swim\Product\Repositories;

use Illuminate\Container\Container as App;
use Swim\Core\Eloquent\Repository;
use Swim\Product\Repositories\ProductRepository;

/**
 * Search Reposotory
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com> @prashant-Swim
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class SearchRepository extends Repository
{
    /**
     * ProductRepository object
     *
     * @return Object
     */
    protected $productRepository;

    /**
     * Create a new repository instance.
     *
     * @param  Swim\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        App $app
    )
    {
        parent::__construct($app);

        $this->productRepository = $productRepository;
    }

    function model()
    {
        return 'Swim\Product\Contracts\Product';
    }

    public function search($data)
    {
        $products = $this->productRepository->searchProductByAttribute($data['term']);

        return $products;
    }
}