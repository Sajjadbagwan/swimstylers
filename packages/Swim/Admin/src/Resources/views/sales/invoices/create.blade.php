@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.sales.invoices.add-title') }}
@stop

@section('content-wrapper')
    <div class="content full-page">
        <form method="POST" action="{{ route('admin.sales.invoices.store', $order->id) }}" @submit.prevent="onSubmit">
            @csrf()

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.sales.invoices.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.invoices.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="sale-container">

                    <accordian :title="'{{ __('admin::app.sales.orders.order-and-account') }}'" :active="true">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.order-info') }}</span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.invoices.order-id') }}
                                        </span>

                                        <span class="value">
                                            <a href="{{ route('admin.sales.orders.view', $order->id) }}">#{{ $order->increment_id }}</a>
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.order-date') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->created_at }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.order-status') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->status_label }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.channel') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->channel_name }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.account-info') }}</span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.customer-name') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->customer_full_name }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.email') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->customer_email }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.sales.orders.address') }}'" :active="true">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.billing-address') }}</span>
                                </div>

                                <div class="section-content">

                                    @include ('admin::sales.address', ['address' => $order->billing_address])

                                </div>
                            </div>

                            @if ($order->shipping_address)
                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.shipping-address') }}</span>
                                    </div>

                                    <div class="section-content">

                                        @include ('admin::sales.address', ['address' => $order->shipping_address])

                                    </div>
                                </div>
                            @endif

                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.sales.orders.payment-and-shipping') }}'" :active="true">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.payment-info') }}</span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.payment-method') }}
                                        </span>

                                        <span class="value">
                                            {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.currency') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->order_currency_code }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if ($order->shipping_address)
                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.shipping-info') }}</span>
                                    </div>

                                    <div class="section-content">
                                        <div class="row">
                                            <span class="title"> 
                                                {{ __('admin::app.sales.orders.shipping-method') }}
                                            </span>

                                            <span class="value"> 
                                                {{ $order->shipping_title }}
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="title"> 
                                                {{ __('admin::app.sales.orders.shipping-price') }}
                                            </span>

                                            <span class="value"> 
                                                {{ core()->formatBasePrice($order->base_shipping_amount) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.sales.orders.products-ordered') }}'" :active="true">
                        <div slot="body">

                            <div class="table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin::app.sales.orders.SKU') }}</th>
                                            <th>{{ __('admin::app.sales.orders.product-name') }}</th>
                                            <th>{{ __('admin::app.sales.invoices.qty-ordered') }}</th>
                                            <th>{{ __('admin::app.sales.invoices.qty-to-invoice') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($order->items as $item)
                                            @if ($item->qty_to_invoice > 0)
                                                <tr>
                                                    <td>{{ $item->getTypeInstance()->getOrderedItem($item)->sku }}</td>
                                                    <td>
                                                        {{ $item->name }}

                                                       <?php 
                                                    if(!empty($item->additional['class_id'])){ ?>
                                                        @if (isset($item->additional))
                                                        <div class="item-options" style="padding-top: 10px;">
                                                                <img src="https://img.icons8.com/android/24/000000/calendar.png" style="width: 18px;" /><b> : </b>{{ date('l', strtotime($item->additional['class_start_date'])) }}</br>
                                                        <img src="https://img.icons8.com/android/24/000000/time.png" style="width: 18px;"/><b> : </b>
                                                        {{$item->additional['class_time'] }}</br>
                                                        <b><img src="https://img.icons8.com/material/24/000000/google-maps-new.png" style="width: 18px;"/> : </b>
                                                        {{$item->additional['class_address'] }}</br>
                                                        <b><img src="https://img.icons8.com/android/24/000000/calendar.png" style="width: 18px;"/> : </b>
                                                        {{ date ("l d M, Y", strtotime ($item->additional['class_start_date'])) }}</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date ("l d M, Y", strtotime ($item->additional['class_start_date']."+7 days")) }}</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date ("l d M, Y", strtotime ($item->additional['class_start_date'] ."+14 days")) }}</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date ("l d M, Y", strtotime ($item->additional['class_start_date']."+21 days")) }}</br>
                                                        </div>
                                                    @endif
                                                   <?php } else { ?>
                                                    @if (isset($item->additional['attributes']))
                                                        <div class="item-options">
                                                            
                                                            @foreach ($item->additional['attributes'] as $attribute)
                                                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                <?php } ?>
                                                    </td>
                                                    <td>{{ $item->qty_ordered }}</td>
                                                    <td>
                                                        <div class="control-group" :class="[errors.has('invoice[items][{{ $item->id }}]') ? 'has-error' : '']">
                                                            <input type="text" v-validate="'required|numeric|min:0'" class="control" id="invoice[items][{{ $item->id }}]" name="invoice[items][{{ $item->id }}]" value="{{ $item->qty_to_invoice }}" data-vv-as="&quot;{{ __('admin::app.sales.invoices.qty-to-invoice') }}&quot;"/>

                                                            <span class="control-error" v-if="errors.has('invoice[items][{{ $item->id }}]')">
                                                                @verbatim
                                                                    {{ errors.first('invoice[items][<?php echo $item->id ?>]') }}
                                                                @endverbatim
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop