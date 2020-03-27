<?php

namespace Webkul\Admin\Http\Controllers\Masters;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Masters\Repositories\BranchRepository;

/**
 * Masters Branch controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * BranchRepository object
     *
     * @var array
     */
    protected $branchRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Masters\Repositories\BranchRepository $branchRepository
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('admin');

        $this->_config = request('_config');

       // $this->branchRepository = $branchRepository;

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

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $branch = $this->branchRepository->findOrFail($id);

        return view($this->_config['view'], compact('branch'));
    }

    /**
     * Cancel action for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = $this->branchRepository->findWhere([['code']]);

       // $channelName = $this->channelRepository->all();

        return view($this->_config['view'], compact('branch', 'channelName'));
    }
    /*public function cancel($id)
    {
        $result = $this->orderRepository->cancel($id);

        if ($result) {
            session()->flash('success', trans('admin::app.response.cancel-success', ['name' => 'Order']));
        } else {
            session()->flash('error', trans('admin::app.response.cancel-error', ['name' => 'Order']));
        }

        return redirect()->back();
    } */
}