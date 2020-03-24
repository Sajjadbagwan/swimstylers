<?php

namespace Swim\Shop\Http\Controllers;

use Swim\Category\Repositories\CategoryRepository;

/**
 * Category controller
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com> @prashant-Swim
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CategoryController extends Controller
{
    /**
     * CategoryRepository object
     *
     * @var array
     */
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Category\Repositories\CategoryRepository $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        parent::__construct();
    }
}
