@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.masters.branch.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.masters.branch.title') }}</h1>
            </div>

            <div class="page-action">
                 <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>
                <a href="{{ route('admin.branch.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.masters.branch.add-title') }}
                </a>
            </div>
        </div>

         <div class="page-content">
            @inject('branchGrid', 'Webkul\Admin\DataGrids\BranchDataGrid')
            <?php //echo "<pre>";print_r($branchGrid);exit(); ?>
            {!! $branchGrid->render() !!}
            
        </div>
    </div>

   

@stop
