<?php

namespace Swim\Shop\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Swim\Product\Repositories\ProductRepository;
use Swim\Product\Repositories\ProductAttributeValueRepository;
use Swim\Product\Repositories\ProductDownloadableSampleRepository;
use Swim\Product\Repositories\ProductDownloadableLinkRepository;

/**
 * Product controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ProductController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var array
     */
    protected $productRepository;

    /**
     * ProductAttributeValueRepository object
     *
     * @var array
     */
    protected $productAttributeValueRepository;

    /**
     * ProductDownloadableSampleRepository object
     *
     * @var array
     */
    protected $productDownloadableSampleRepository;

    /**
     * ProductDownloadableLinkRepository object
     *
     * @var array
     */
    protected $productDownloadableLinkRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Product\Repositories\ProductRepository                   $productRepository
     * @param  \Swim\Product\Repositories\productAttributeValueRepository     $productAttributeValueRepository
     * @param  \Swim\Product\Repositories\ProductDownloadableSampleRepository $productDownloadableSampleRepository
     * @param  \Swim\Product\Repositories\ProductDownloadableLinkRepository   $productDownloadableLinkRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductAttributeValueRepository $productAttributeValueRepository,
        ProductDownloadableSampleRepository $productDownloadableSampleRepository,
        ProductDownloadableLinkRepository $productDownloadableLinkRepository
    )
    {
        $this->productRepository = $productRepository;

        $this->productAttributeValueRepository = $productAttributeValueRepository;

        $this->productDownloadableSampleRepository = $productDownloadableSampleRepository;

        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

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
        $productAttribute = $this->productAttributeValueRepository->findOneWhere([
            'product_id'   => $productId,
            'attribute_id' => $attributeId
        ]);

        return Storage::download($productAttribute['text_value']);
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
                $productDownloadableLink = $this->productDownloadableLinkRepository->findOrFail(request('id'));

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
