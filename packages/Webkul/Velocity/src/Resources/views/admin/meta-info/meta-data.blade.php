@extends('admin::layouts.content')

@section('page_title')
    {{ __('velocity::app.admin.meta-data.title') }}
@stop

@section('content')
    <div class="content">
        <form
            method="POST"
            @submit.prevent="onSubmit"
            enctype="multipart/form-data"
            @if ($metaData)
                action="{{ route('velocity.admin.store.meta-data', ['id' => $metaData->id]) }}"
            @else
                action="{{ route('velocity.admin.store.meta-data', ['id' => 'new']) }}"
            @endif
            >

            @csrf

            <div class="page-header">
                <div class="page-title">
                    <h1>{{ __('velocity::app.admin.meta-data.title') }}</h1>
                </div>
                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('velocity::app.admin.meta-data.update-meta-data') }}
                    </button>
                </div>
            </div>

            <accordian :title="'{{ __('velocity::app.admin.meta-data.general') }}'" :active="true">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.activate-slider') }}</label>

                        <label class="switch">
                            <input
                                type="checkbox"
                                class="control"
                                id="slides"
                                name="slides"
                                data-vv-as="&quot;slides&quot;"
                                {{ $metaData && $metaData->slider ? 'checked' : ''}} />

                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.sidebar-categories') }}</label>

                        <input
                            type="text"
                            class="control"
                            id="sidebar_category_count"
                            name="sidebar_category_count"
                            value="{{ $metaData ? $metaData->sidebar_category_count : '10' }}" />
                    </div>

                    <div class="control-group">
                        <label>{{ __('shop::app.home.featured-products') }}</label>

                        <input
                            type="text"
                            class="control"
                            id="featured_product_count"
                            name="featured_product_count"
                            value="{{ $metaData ? $metaData->featured_product_count : 10 }}" />
                    </div>

                    <div class="control-group">
                        <label>{{ __('shop::app.home.new-products') }}</label>

                        <input
                            type="text"
                            class="control"
                            id="new_products_count"
                            name="new_products_count"
                            value="{{ $metaData ? $metaData->new_products_count : 10 }}" />
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.home-page-content') }}</label>

                        <textarea
                            class="control"
                            id="home_page_content"
                            name="home_page_content">
                            {{ $metaData ? $metaData->home_page_content : '' }}
                        </textarea>
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.product-policy') }}</label>

                        <textarea
                            class="control"
                            id="product-policy"
                            name="product_policy">
                            {{ $metaData ? $metaData->product_policy : '' }}
                        </textarea>
                    </div>

                </div>
            </accordian>

            <accordian :title="'{{ __('velocity::app.admin.meta-data.images') }}'" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.advertisement-four') }}</label>

                        @if(! isset($metaData->advertisement[4]))
                            <image-wrapper
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'"
                                input-name="images[4]">
                            </image-wrapper>
                        @else
                            <image-wrapper
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'"
                                input-name="images[4]" :images='@json($metaData->advertisement[4])'>
                            </image-wrapper>
                        @endif
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.advertisement-three') }}</label>
                        @if(! isset($metaData->advertisement[3]))
                            <image-wrapper
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'"
                                input-name="images[3]">
                            </image-wrapper>
                        @else
                            <image-wrapper
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'"
                                input-name="images[3]" :images='@json($metaData->advertisement[3])'>
                            </image-wrapper>
                        @endif
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.advertisement-two') }}</label>

                        @if(! isset($metaData->advertisement[2]))
                            <image-wrapper
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'"
                                input-name="images[2]">
                            </image-wrapper>
                        @else
                            <image-wrapper
                                :button-label="'{{ __('velocity::app.admin.meta-data.add-image-btn-title') }}'"
                                input-name="images[2]" :images='@json($metaData->advertisement[2])'>
                            </image-wrapper>
                        @endif
                    </div>
                </div>
            </accordian>

            <accordian :title="'{{ __('velocity::app.admin.meta-data.footer') }}'" :active="false">
                <div slot="body">
                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.subscription-content') }}</label>

                        <textarea
                            class="control"
                            id="subscription_bar_content"
                            name="subscription_bar_content">
                            {{ $metaData ? $metaData->subscription_bar_content : '' }}
                        </textarea>
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.footer-left-content') }}</label>

                        <textarea
                            class="control"
                            id="footer_left_content"
                            name="footer_left_content">
                            {{ $metaData ? $metaData->footer_left_content : '' }}
                        </textarea>
                    </div>

                    <div class="control-group">
                        <label>{{ __('velocity::app.admin.meta-data.footer-middle-content') }}</label>

                        <textarea
                            class="control"
                            id="footer_middle_content"
                            name="footer_middle_content">
                            {{ $metaData ? $metaData->footer_middle_content : '' }}
                        </textarea>
                    </div>
                </div>
            </accordian>
        </form>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/Swim/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                height: 200,
                width: "100%",
                image_advtab: true,
                valid_elements : '*[*]',
                selector: 'textarea#home_page_content,textarea#footer_left_content,textarea#subscription_bar_content,textarea#footer_middle_content,textarea#product-policy',
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
            });
        });
    </script>
@endpush
