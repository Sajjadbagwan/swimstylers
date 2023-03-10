<div class="form-container">
    <div class="form-header mb-30">
        <span class="checkout-step-heading">{{ __('shop::app.checkout.onepage.summary') }}</span>
    </div>

    <div class="address-summary">
        @if ($billingAddress = $cart->billing_address)
            <div class="billing-address">
                <div class="card-title mb-20">
                    <b>{{ __('shop::app.checkout.onepage.billing-address') }}</b>
                </div>

                <div class="card-content">
                    <ul>
                        <li class="mb-10">
                            {{ $billingAddress->first_name }} {{ $billingAddress->last_name }}
                        </li>
                        <li class="mb-10">
                            {{ $billingAddress->address1 }},<br/> {{ $billingAddress->state }}
                        </li>
                        <li class="mb-10">
                            {{ core()->country_name($billingAddress->country) }} {{ $billingAddress->postcode }}
                        </li>

                        <span class="horizontal-rule mb-15 mt-15"></span>

                        <li class="mb-10">
                            {{ __('shop::app.checkout.onepage.contact') }} : {{ $billingAddress->phone }}
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        @if ($cart->haveStockableItems() && $shippingAddress = $cart->shipping_address)
            <div class="shipping-address">
                <div class="card-title mb-20">
                    <b>{{ __('shop::app.checkout.onepage.shipping-address') }}</b>
                </div>

                <div class="card-content">
                    <ul>
                        <li class="mb-10">
                            {{ $shippingAddress->first_name }} {{ $shippingAddress->last_name }}
                        </li>
                        <li class="mb-10">
                            {{ $shippingAddress->address1 }},<br/> {{ $shippingAddress->state }}
                        </li>
                        <li class="mb-10">
                            {{ core()->country_name($shippingAddress->country) }} {{ $shippingAddress->postcode }}
                        </li>

                        <span class="horizontal-rule mb-15 mt-15"></span>

                        <li class="mb-10">
                            {{ __('shop::app.checkout.onepage.contact') }} : {{ $shippingAddress->phone }}
                        </li>
                    </ul>
                </div>
            </div>
        @endif

    </div>

    @inject ('productImageHelper', 'Swim\Product\Helpers\ProductImage')

    <div class="cart-item-list mt-20">
        @foreach ($cart->items as $item)
        <?php    if($item['product_type'] != "class"){  ?>
            @php
                $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);
            @endphp

            <div class="item mb-5" style="margin-bottom: 5px;">
                <div class="item-image">
                    <img src="{{ $productBaseImage['medium_image_url'] }}" />
                </div>

                <div class="item-details">

                    {!! view_render_event('bagisto.shop.checkout.name.before', ['item' => $item]) !!}

                    <div class="item-title">
                        {{ $item->product->name }}
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.name.after', ['item' => $item]) !!}
                    {!! view_render_event('bagisto.shop.checkout.price.before', ['item' => $item]) !!}

                    <div class="row">
                        <span class="title">
                            {{ __('shop::app.checkout.onepage.price') }}
                        </span>
                        <span class="value">
                            {{ core()->currency($item->base_price) }}
                        </span>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.price.after', ['item' => $item]) !!}
                    {!! view_render_event('bagisto.shop.checkout.quantity.before', ['item' => $item]) !!}

                    <div class="row">
                        <span class="title">
                            {{ __('shop::app.checkout.onepage.quantity') }}
                        </span>
                        <span class="value">
                            {{ $item->quantity }}
                        </span>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.quantity.after', ['item' => $item]) !!}

                    {!! view_render_event('bagisto.shop.checkout.options.before', ['item' => $item]) !!}

                    @if (isset($item->additional['attributes']))
                        <div class="item-options">

                            @foreach ($item->additional['attributes'] as $attribute)
                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                            @endforeach

                        </div>
                    @endif

                    {!! view_render_event('bagisto.shop.checkout.options.after', ['item' => $item]) !!}
                </div>
            </div>
        <?php }else { ?>
                <div class="item mb-5" style="margin-bottom: 5px;">
                <div class="item-image">
                   <img src="http://127.0.0.1:8000/vendor/Swim/ui/assets/images/product/meduim-product-placeholder.png" />
                </div>

                <div class="item-details">

                    {!! view_render_event('bagisto.shop.checkout.name.before', ['item' => $item]) !!}

                    <div class="item-title">
                        {{ $item['name'] }}
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.name.after', ['item' => $item]) !!}
                    {!! view_render_event('bagisto.shop.checkout.price.before', ['item' => $item]) !!}

                    <div class="row">
                        <span class="title">
                            {{ __('shop::app.checkout.onepage.price') }}
                        </span>
                        <span class="value">
                            {{ core()->currency($item->base_price) }}
                        </span>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.price.after', ['item' => $item]) !!}
                    {!! view_render_event('bagisto.shop.checkout.quantity.before', ['item' => $item]) !!}

                    <div class="row">
                        <span class="title">
                            {{ __('shop::app.checkout.onepage.quantity') }}
                        </span>
                        <span class="value">
                            {{ $item->quantity }}
                        </span>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.quantity.after', ['item' => $item]) !!}

                    {!! view_render_event('bagisto.shop.checkout.options.before', ['item' => $item]) !!}

                    @if (isset($item->additional))
                        <div class="item-options">
                            <b><img src="https://img.icons8.com/android/24/000000/calendar.png"/>    : </b>{{ date('l', strtotime($item->additional['class_start_date'])) }}</br>
                            <b><img src="https://img.icons8.com/android/24/000000/time.png"/> : </b>
                            {{$item->additional['class_time'] }}</br>
                            <b><img src="https://img.icons8.com/material/24/000000/google-maps-new.png"/> : </b>
                            {{$item->additional['class_address'] }}</br>
                            <b><img src="https://img.icons8.com/android/24/000000/calendar.png"/> : </b>
                            {{ date ("l d M, Y", strtotime ($item->additional['class_start_date'])) }}</br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date ("l d M, Y", strtotime ($item->additional['class_start_date']."+7 days")) }}</br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date ("l d M, Y", strtotime ($item->additional['class_start_date'] ."+14 days")) }}</br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date ("l d M, Y", strtotime ($item->additional['class_start_date']."+21 days")) }}</br>
                        </div>
                    @endif

                    {!! view_render_event('bagisto.shop.checkout.options.after', ['item' => $item]) !!}
                </div>
            </div>
        <?php  }
?>        @endforeach
    </div>

    <div class="order-description mt-20">
        <div class="pull-left" style="width: 60%; float: left;">
            @if ($cart->haveStockableItems())
                <div class="shipping">
                    <div class="decorator">
                        <i class="icon shipping-icon"></i>
                    </div>

                    <div class="text">
                        {{ core()->currency($cart->selected_shipping_rate->base_price) }}

                        <div class="info">
                            {{ $cart->selected_shipping_rate->method_title }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="payment">
                <div class="decorator">
                    <i class="icon payment-icon"></i>
                </div>

                <div class="text">
                    {{ core()->getConfigData('sales.paymentmethods.' . $cart->payment->method . '.title') }}
                </div>
            </div>

        </div>

        <div class="pull-right" style="width: 40%; float: left;">
            <slot name="summary-section"></slot>
        </div>
    </div>
</div>