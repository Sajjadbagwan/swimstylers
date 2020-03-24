<?php

namespace Swim\Shop\Http\Controllers;

use Swim\Shop\Http\Controllers\Controller;
use Swim\Core\Repositories\SliderRepository;

/**
 * Home page controller
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com> @prashant-Swim
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
 class HomeController extends Controller
{
    /**
     * SliderRepository object
     *
     * @var Object
    */
    protected $sliderRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Core\Repositories\SliderRepository $sliderRepository
     * @return void
    */
    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;

        parent::__construct();
    }

    /**
     * loads the home page for the storefront
     * 
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        $currentChannel = core()->getCurrentChannel();
        
        $sliderData = $this->sliderRepository->findByField('channel_id', $currentChannel->id)->toArray();

        return view($this->_config['view'], compact('sliderData'));
    }

    /**
     * loads the home page for the storefront
     */
    public function notFound()
    {
        abort(404);
    }
}