<?php

namespace Swim\CMS\Http\Controllers\Shop;

use Swim\CMS\Http\Controllers\Controller;
use Swim\CMS\Repositories\CmsRepository;

/**
 * PagePresenter controller
 *
 * @author  Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class PagePresenterController extends Controller
{
    /**
     * CmsRepository object
     *
     * @var Object
     */
    protected $cmsRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\CMS\Repositories\CmsRepository $cmsRepository
     * @return void
     */
    public function __construct(CmsRepository $cmsRepository)
    {
        $this->cmsRepository = $cmsRepository;
    }

    /**
     * To extract the page content and load it in the respective view file
     *
     * @param string $urlKey
     * @return \Illuminate\View\View
     */
    public function presenter($urlKey)
    {
        $page = $this->cmsRepository->findByUrlKeyOrFail($urlKey);

        return view('shop::cms.page')->with('page', $page);
    }
}