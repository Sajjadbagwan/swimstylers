<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Webkul\Classes\Repositories\ClassesRepository;
use Webkul\Classes\Repositories\ClassesAttributeValueRepository;
use Webkul\Classes\Repositories\ClassesDownloadableSampleRepository;
use Webkul\Classes\Repositories\ClassesDownloadableLinkRepository;

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
     * ProductAttributeValueRepository object
     *
     * @var array
     */
    protected $classesAttributeValueRepository;

    /**
     * ProductDownloadableSampleRepository object
     *
     * @var array
     */
    protected $classesDownloadableSampleRepository;

    /**
     * ProductDownloadableLinkRepository object
     *
     * @var array
     */
    protected $classesDownloadableLinkRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Product\Repositories\ProductRepository                   $productRepository
     * @param  \Webkul\Product\Repositories\productAttributeValueRepository     $productAttributeValueRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableSampleRepository $productDownloadableSampleRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableLinkRepository   $productDownloadableLinkRepository
     * @return void
     */
    public function __construct(
        ClassesRepository $classesRepository,
        ClassesAttributeValueRepository $classesAttributeValueRepository,
        ClassesDownloadableSampleRepository $classesDownloadableSampleRepository,
        ClassesDownloadableLinkRepository $classesDownloadableLinkRepository
    )
    {
        $this->classesRepository = $classesRepository;

        $this->classesAttributeValueRepository = $classesAttributeValueRepository;

        $this->classesDownloadableSampleRepository = $classesDownloadableSampleRepository;

        $this->classesDownloadableLinkRepository = $classesDownloadableLinkRepository;

        parent::__construct();
    }

    /**
     * Download image or file
     *
     * @param  int $productId, $attributeId
     * @return \Illuminate\Http\Response
     */
    public function download($productId, $attributeId)
    {
        $classesAttribute = $this->classesAttributeValueRepository->findOneWhere([
            'classes_id'   => $productId,
            'attribute_id' => $attributeId
        ]);

        return Storage::download($classesAttribute['text_value']);
    }

    /**
     * Download the for the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadSample()
    {
        try {
            if (request('type') == 'link') {
                $classesDownloadableLink = $this->productDownloadableLinkRepository->findOrFail(request('id'));

                if ($productDownloadableLink->sample_type == 'file')
                    return Storage::download($productDownloadableLink->sample_file);
                else {
                    $fileName = $name = substr($productDownloadableLink->sample_url, strrpos($productDownloadableLink->sample_url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableLink->sample_url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            } else {
                $productDownloadableSample = $this->productDownloadableSampleRepository->findOrFail(request('id'));

                if ($productDownloadableSample->type == 'file')
                    return Storage::download($productDownloadableSample->file);
                else {
                    $fileName = $name = substr($productDownloadableSample->url, strrpos($productDownloadableSample->url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableSample->url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            }
        } catch(\Exception $e) {
            abort(404);
        }
    }
}
