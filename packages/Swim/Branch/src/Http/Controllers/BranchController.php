<?php
namespace Swim\Branch\Http\Controllers;
class BranchController extends Controller{
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }

    public function index()
    {
        return view($this->_config['view']);
    }
}
