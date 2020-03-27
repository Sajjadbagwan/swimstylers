@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.master.branch.add-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <form method="POST" action="{{ route('admin.master.invoices.store', $order->id) }}" @submit.prevent="onSubmit">
            @csrf()
            
        </form>
    </div>
@stop