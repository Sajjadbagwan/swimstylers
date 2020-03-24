<?php

namespace Swim\Tax\Http\Controllers;

/**
 * Tax controller
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class TaxController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');

        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        return view($this->_config['view']);
    }
}