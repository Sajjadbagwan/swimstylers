<?php

namespace Swim\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Swim\Category\Repositories\CategoryRepository;
use Swim\API\Http\Resources\Catalog\Category as CategoryResource;

/**
 * Category controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
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
     * @param  Swim\Category\Repositories\CategoryRepository $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(
                $this->categoryRepository->getVisibleCategoryTree(request()->input('parent_id'))
            );
    }
}
