<?php

namespace Swim\Velocity\DataGrids;

use Swim\Ui\DataGrid\DataGrid;
use DB;

/**
 * Category DataGrid
 *
 * @author Vivek Sharma <viveksh047@Swim.com> @viveksh-Swim
 * @copyright 2019 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CategoryDataGrid extends DataGrid
{
    protected $index = 'category_menu_id'; //the column that needs to be treated as index column

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $defaultChannel = core()->getCurrentChannel();

        $queryBuilder = DB::table('velocity_category as v_cat')
                ->select('v_cat.id as category_menu_id', 'v_cat.category_id', 'ct.name', 'v_cat.icon', 'v_cat.tooltip', 'v_cat.status')
                ->leftJoin('categories as c', 'c.id', '=', 'v_cat.category_id')
                ->leftJoin('category_translations as ct', function($leftJoin) {
                    $leftJoin->on('c.id', '=', 'ct.category_id')
                        ->where('ct.locale', app()->getLocale());
                })
                ->where('c.parent_id', $defaultChannel->root_category_id)
                ->groupBy('v_cat.id');

        // $this->addFilter('content_id', 'con.id');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'category_id',
            'label' => trans('velocity::app.admin.category.datagrid.category-id'),
            'type' => 'number',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('velocity::app.admin.category.datagrid.category-name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'icon',
            'label' => trans('velocity::app.admin.category.datagrid.category-icon'),
            'type' => 'string',
            'sortable' => true,
            'searchable' => true,
            'filterable' => true,
            'closure' => true,
            'wrapper' => function ($row) {
                return '<span class="wk-icon '.$row->icon.'"></span>';
            }
        ]);

        $this->addColumn([
            'index' => 'status',
            'label' => trans('velocity::app.admin.category.datagrid.category-status'),
            'type' => 'string',
            'sortable' => true,
            'searchable' => true,
            'filterable' => true,
            'closure' => true,
            'wrapper' => function($row) {
                if ( $row->status ) {
                    return '<span class="badge badge-md badge-success">Enabled</span>';
                } else {
                    return '<span class="badge badge-md badge-danger">Disabled</span>';
                }
            }
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'type' => 'Edit',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'velocity.admin.category.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'type' => 'Delete',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'velocity.admin.category.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Category']),
            'icon' => 'icon trash-icon'
        ]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'type' => 'delete',
            'action' => route('velocity.admin.category.mass-delete'),
            'label' => trans('admin::app.datagrid.delete'),
            'method' => 'DELETE'
        ]);
    }
}
