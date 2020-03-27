<?php

namespace Swim\Admin\Http\Controllers\Development;

use Swim\Admin\Http\Controllers\Controller;

/**
 * Dashboard controller
 *
 * @author    Alexey Khachatryan <info@khachatryan.org>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::settings.development.dashboard');
    }
}