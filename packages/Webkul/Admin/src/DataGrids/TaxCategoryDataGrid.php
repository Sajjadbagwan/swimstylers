<?php

namespace Swim\Admin\DataGrids;

use Swim\Ui\DataGrid\DataGrid;
use DB;

/**
 * TaxCategoryDataGrid Class
 *
 * @author Prashant Singh <prashant.singh852@Swim.com> @prashant-Swim
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class TaxCategoryDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('tax_categories')->addSelect('id', 'name', 'code');

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
            'index' => 'name',
            'label' => trans('admin::app.datagrid.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'code',
            'label' => trans('admin::app.datagrid.code'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'title' => 'Edit Tax Category',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'admin.tax-categories.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => 'Delete Tax Category',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'admin.tax-categories.delete',
            'icon' => 'icon trash-icon'
        ]);
    }
}