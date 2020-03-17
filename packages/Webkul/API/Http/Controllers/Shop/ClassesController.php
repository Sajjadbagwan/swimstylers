<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Classes\Repositories\ProductRepository;
use Webkul\API\Http\Resources\Classes as ClassesResource;

/**
 * Product controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
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
     * @param  Webkul\Product\Repositories\ProductRepository $productRepository
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
                'data' => app('Webkul\Classes\Helpers\View')->getAdditionalData($this->classesRepository->findOrFail($id))
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
                'data' => app('Webkul\Classes\Helpers\ConfigurableOption')->getConfigurationConfig($this->classesRepository->findOrFail($id))
            ]);
    }
}
