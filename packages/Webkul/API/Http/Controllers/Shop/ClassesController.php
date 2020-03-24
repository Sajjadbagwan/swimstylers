<?php

namespace Swim\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Swim\Classes\Repositories\ProductRepository;
use Swim\API\Http\Resources\Classes as ClassesResource;

/**
 * Product controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ClassesController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var array
     */
    protected $classesRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Swim\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(ClassesRepository $classesRepository)
    {
        $this->classesRepository = $classesRepository;
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClassesResource::collection($this->classesRepository->getAll(request()->input('category_id')));
    }

    /**
     * Returns a individual resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return new ClassesResource(
                $this->classesRepository->findOrFail($id)
            );
    }

    /**
     * Returns product's additional information.
     *
     * @return \Illuminate\Http\Response
     */
    public function additionalInformation($id)
    {
        return response()->json([
                'data' => app('Swim\Classes\Helpers\View')->getAdditionalData($this->classesRepository->findOrFail($id))
            ]);
    }

    /**
     * Returns product's additional information.
     *
     * @return \Illuminate\Http\Response
     */
    public function configurableConfig($id)
    {
        return response()->json([
                'data' => app('Swim\Classes\Helpers\ConfigurableOption')->getConfigurationConfig($this->classesRepository->findOrFail($id))
            ]);
    }
}
