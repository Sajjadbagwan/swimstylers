<?php

namespace Swim\Shop\Http\Controllers;

use Swim\Product\Repositories\SearchRepository;

/**
 * Search controller
 *
 * @author  Prashant Singh <prashant.singh852@Swim.com> @prashant-Swim
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
 class SearchController extends Controller
{
    /**
     * SearchRepository object
     *
     * @var Object
    */
    protected $searchRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Product\Repositories\SearchRepository $searchRepository
     * @return void
    */
    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;

        parent::__construct();
    }

    /**
     * Index to handle the view loaded with the search results
     * 
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        $results = $this->searchRepository->search(request()->all());

        return view($this->_config['view'])->with('results', $results->count() ? $results : null);
    }
}
