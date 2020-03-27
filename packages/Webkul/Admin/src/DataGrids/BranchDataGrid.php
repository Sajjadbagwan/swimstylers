<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * BranchDataGrid Class
 *
 * @author Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BranchDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortBranch = 'desc'; //asc or desc

    protected $itemsPerPage = 10;

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('branch_master')
                ->select('id')
                ->addSelect('id','branch_name', 'branch_desc', 'branch_image', 'created_at');
       
       /* $this->addFilter('id', 'id');
        $this->addFilter('branch_name', DB::raw('CONCAT(' . DB::getTablePrefix() . 'branch_name, " ", ' . DB::getTablePrefix() . 'branch_name)'));
        $this->addFilter('branch_desc', DB::raw('CONCAT(' . DB::getTablePrefix() . 'branch_desc, " ", ' . DB::getTablePrefix() . 'branch_desc)'));
        
        $this->addFilter('created_at', 'created_at');*/

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => trans('admin::app.datagrid.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'branch_name',
            'label' => trans('admin::app.datagrid.branch_name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);
        $this->addColumn([
            'index' => 'branch_desc',
            'label' => trans('admin::app.datagrid.branch_desc'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

          $this->addColumn([
            'index' => 'branch_image',
            'label' => trans('admin::app.datagrid.branch_image'),
            'type' => 'string',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'created_at',
            'label' => trans('admin::app.datagrid.created_at'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => true,
            'filterable' => true
        ]);

    }

    public function prepareActions() {
        $this->addAction([
            'title' => 'Branch View',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'admin.masters.branch.view',
            'icon' => 'icon eye-icon'
        ]);

        $this->addAction([
            'title' => 'Edit Branch',
            'method' => 'GET', //use get for redirects only
            'route' => 'admin.masters.branch.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => 'Delete Branch',
            'method' => 'POST', // other than get request it fires ajax and self refreshes datagrid
            'route' => 'admin.masters.branch.delete',
            'icon' => 'icon trash-icon'
        ]);
    }
}