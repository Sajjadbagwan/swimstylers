<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>@yield('page_title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" sizes="16x16" href="{{ asset('vendor/webkul/ui/assets/images/favicon.ico') }}" />

        <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/webkul/admin/assets/css/admin.css') }}">

        @yield('head')

        @yield('css')

        {!! view_render_event('bagisto.admin.layout.head') !!}

    </head>

    <body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">
        {!! view_render_event('bagisto.admin.layout.body.before') !!}

        <div id="app">

            <flash-wrapper ref='flashes'></flash-wrapper>

            {!! view_render_event('bagisto.admin.layout.nav-top.before') !!}

            @include ('admin::layouts.nav-top')

            {!! view_render_event('bagisto.admin.layout.nav-top.after') !!}


            {!! view_render_event('bagisto.admin.layout.nav-left.before') !!}

            @include ('admin::layouts.nav-left')

            {!! view_render_event('bagisto.admin.layout.nav-left.after') !!}


            <div class="content-container">

                {!! view_render_event('bagisto.admin.layout.content.before') !!}

                @yield('content-wrapper')

                {!! view_render_event('bagisto.admin.layout.content.after') !!}

            </div>

        </div>

        <script type="text/javascript">
            window.flashMessages = [];

            @if ($success = session('success'))
                window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}" }];
            @elseif ($warning = session('warning'))
                window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}" }];
            @elseif ($error = session('error'))
                window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}" }];
            @elseif ($info = session('info'))
                window.flashMessages = [{'type': 'alert-info', 'message': "{{ $info }}" }];
            @endif

            window.serverErrors = [];
            @if (isset($errors))
                @if (count($errors))
                    window.serverErrors = @json($errors->getMessages());
                @endif
            @endif


        </script>

        <script type="text/javascript" src="{{ asset('vendor/webkul/admin/assets/js/admin.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', function() {
                moveDown = 60;
                moveUp =  -60;
                count = 0;
                countKeyUp = 0;
                pageDown = 60;
                pageUp = -60;
                scroll = 0;

                listLastElement = $('.menubar li:last-child').offset();

                if (listLastElement) {
                    lastElementOfNavBar = listLastElement.top;
                }

                navbarTop = $('.navbar-left').css("top");
                menuTopValue = $('.navbar-left').css('top');
                menubarTopValue = menuTopValue;

                documentHeight = $(document).height();
                menubarHeight = $('ul.menubar').height();
                navbarHeight = $('.navbar-left').height();
                windowHeight = $(window).height();
                contentHeight = $('.content').height();
                innerSectionHeight = $('.inner-section').height();
                gridHeight = $('.grid-container').height();
                pageContentHeight = $('.page-content').height();

                if (menubarHeight <= windowHeight) {
                    differenceInHeight = windowHeight - menubarHeight;
                } else {
                    differenceInHeight = menubarHeight - windowHeight;
                }

                if (menubarHeight > windowHeight) {
                    document.addEventListener("keydown", function(event) {
                        if ((event.keyCode == 38) && count <= 0) {
                            count = count + moveDown;

                            $('.navbar-left').css("top", count + "px");
                        } else if ((event.keyCode == 40) && count >= -differenceInHeight) {
                            count = count + moveUp;

                            $('.navbar-left').css("top", count + "px");
                        } else if ((event.keyCode == 33) && countKeyUp <= 0) {
                            countKeyUp = countKeyUp + pageDown;

                            $('.navbar-left').css("top", countKeyUp + "px");
                        } else if ((event.keyCode == 34) && countKeyUp >= -differenceInHeight) {
                            countKeyUp = countKeyUp + pageUp;

                            $('.navbar-left').css("top", countKeyUp + "px");
                        } else {
                            $('.navbar-left').css("position", "fixed");
                        }
                    });

                    $("body").css({minHeight: $(".menubar").outerHeight() + 100 + "px"});

                    window.addEventListener('scroll', function() {
                        documentScrollWhenScrolled = $(document).scrollTop();

                            if (documentScrollWhenScrolled <= differenceInHeight + 200) {
                                $('.navbar-left').css('top', -documentScrollWhenScrolled + 60 + 'px');
                                scrollTopValueWhenNavBarFixed = $(document).scrollTop();
                            }
                    });
                }
            });
            $( document ).ready(function() {
                $("#instructor").hide();
                $("#field_profile_dsec").hide();

                $("#branch").hide();
                    $( "#roleId" ).change(function() {
                        $("#instructor").hide();
                        $("#field_profile_dsec").hide();
                        $("#branch").hide();
                        if(this.value == 2){
                            $("#field_profile_dsec").show();
                            $("#instructor").show();
                        }
                        if(this.value == 3 || this.value == 4){
                            $("#field_profile_dsec").show();
                            $("#branch").show();
                        }
                });

                $("form#test").submit(function (e) {
                    var role_id = $('#roleId').val();
                    if(role_id == 2){
                        var profile_dsec = $('#profile_dsec').val();
                        if(profile_dsec == ''){
                            $('#error-profile_dsec').show();
                            $('#error-profile_dsec').html('</br>The "Profile Description" is required.');
                            
                        }else{
                            $('#error-profile_dsec').html('');
                        }

                        var doc_file = $('#dbs_doc_file').val();
                        if(doc_file == ''){
                            $('#error-dbs_doc_file').show();
                            $('#error-dbs_doc_file').html('</br>The "Doc File " is required.');
                            
                        }else{
                            $('#error-dbs_doc_file').html('');
                        }

                        var ios_cert_file = $('#ios_cert_file').val();
                        if(ios_cert_file == ''){
                            $('#error-ios_cert_file').show();
                            $('#error-ios_cert_file').html('</br>The "Ios Cert File " is required.');
                            
                        }else{
                            $('#error-ios_cert_file').html('');
                        }

                        var signed_contract_file = $('#signed_contract_file').val();
                        if(signed_contract_file == ''){
                            $('#error-signed_contract_file').show();
                            $('#error-signed_contract_file').html('</br>The "Signed Contract File " is required.');
                            
                        }else{
                            $('#error-signed_contract_file').html('');
                        }

                        var max_teach_level_name = $('#max_teach_level_name').val();
                        if(max_teach_level_name == ''){
                            $('#error-max_teach_level_name').show();
                            $('#error-max_teach_level_name').html('</br>The "Level Name " is required.');
                            
                        }else{
                            $('#error-max_teach_level_name').html('');
                        }

                        var max_teach_level_stage = $('#max_teach_level_stage').val();
                        if(max_teach_level_stage == ''){
                            $('#error-max_teach_level_stage').show();
                            $('#error-max_teach_level_stage').html('</br>The "Level Stage " is required.');
                            
                        }else{
                            $('#error-max_teach_level_stage').html('');
                        }

                        if(profile_dsec == '' || doc_file == '' || ios_cert_file == '' || signed_contract_file == '' || max_teach_level_name == '' || max_teach_level_stage == ''){
                            return false;    
                        }
                    }
                    if(role_id == 3 || role_id == 4){
                        var job_title = $('#job_title').val();
                        if(job_title == ''){
                            $('#error-job_title').show();
                            $('#error-job_title').html('</br>The "Job Title" is required.');
                            
                        }else{
                            $('#error-job_title').html('');
                        }

                        if(job_title == '' || profile_dsec == ''){
                            return false;    
                        }
                    }     
                });   
            });
        </script>
        @stack('scripts')

        {!! view_render_event('bagisto.admin.layout.body.after') !!}

        <div class="modal-overlay"></div>
    </body>
</html>