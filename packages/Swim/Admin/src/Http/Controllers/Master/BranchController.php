<?php

namespace Swim\Admin\Http\Controllers\Master;

use Swim\Admin\Http\Controllers\Controller;
use Swim\Master\Repositories\BranchRepository;

/**
 * Master Branch controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
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
     * @param  \Swim\Master\Repositories\BranchRepository $branchRepository
     * @return void
     */
    public function __construct(BranchRepository $branchRepository)
    {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->branchRepository = $branchRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        echo "sdsd";exit();
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
        $order = $this->branchRepository->findOrFail($id);

        return view($this->_config['view'], compact('order'));
    }

    /**
     * Cancel action for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function cancel($id)
    {
        $result = $this->branchRepository->cancel($id);

        if ($result) {
            session()->flash('success', trans('admin::app.response.cancel-success', ['name' => 'Order']));
        } else {
            session()->flash('error', trans('admin::app.response.cancel-error', ['name' => 'Order']));
        }

        return redirect()->back();
    }*/
}