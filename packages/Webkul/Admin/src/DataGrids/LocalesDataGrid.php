<?php

namespace Swim\Admin\DataGrids;

use Swim\Ui\DataGrid\DataGrid;
use DB;

/**
 * LocalesDataGrid Class
 *
 * @author Prashant Singh <prashant.singh852@Swim.com> @prashant-Swim
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class LocalesDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('locales')->addSelect('id', 'code', 'name', 'direction');

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
            'index' => 'code',
            'label' => trans('admin::app.datagrid.code'),
            'type' => 'string',
            'searchable' => true,
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
            'index' => 'direction',
            'label' => trans('admin::app.datagrid.direction'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => true,
            'wrapper' => function ($value) {
                if ($value->direction == 'ltr')
                    return trans('admin::app.datagrid.ltr');
                else
                    return trans('admin::app.datagrid.rtl');
            }
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'title' => 'Edit Locales',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'admin.locales.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => 'Delete Locales',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'admin.locales.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Exchange Rate']),
            'icon' => 'icon trash-icon'
        ]);
    }
}