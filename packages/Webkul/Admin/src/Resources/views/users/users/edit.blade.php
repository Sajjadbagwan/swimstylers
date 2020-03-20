@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.users.users.edit-user-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" id="updateValidate" action="{{ route('admin.users.update', $user->id) }}"  enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.users.users.edit-user-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.users.users.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    <accordian :title="'{{ __('admin::app.users.users.general') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('admin::app.users.users.name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('admin::app.users.users.name') }}&quot;" value="{{ $user->name }}"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required">{{ __('admin::app.users.users.email') }}</label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" data-vv-as="&quot;{{ __('admin::app.users.users.email') }}&quot;" value="{{ $user->email }}"/>
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('contact_number') ? 'has-error' : '']">
                                <label for="contact-number" class="required">{{ __('admin::app.users.users.contact_number') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="contact_number" name="contact_number" data-vv-as="&quot;{{ __('admin::app.users.users.contact_number') }}&quot;" value="{{ $user->contact_number }}"/>
                                <span class="control-error" v-if="errors.has('contact_number')">@{{ errors.first('contact_number') }}</span>
                            </div>
                            
                            <div class="control-group">
                                <label for="status">Profile Photo</label>
                                <input type="file" id="image" name="image" class="control"/>
                                @if($user->image)
                                <img src="{{ Storage::url('app/public/'.$user->image) }}" height="40" width="40">
                                @endif
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.users.users.password') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password">{{ __('admin::app.users.users.password') }}</label>
                                <input type="password" v-validate="'min:6|max:18'" class="control" id="password" name="password" ref="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                <label for="password_confirmation">{{ __('admin::app.users.users.confirm-password') }}</label>
                                <input type="password" v-validate="'min:6|max:18|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;{{ __('admin::app.users.users.confirm-password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.users.users.status-and-role') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('role_id') ? 'has-error' : '']">
                                <label for="role" class="required">{{ __('admin::app.users.users.role') }}</label>
                                <select v-validate="'required'" class="control" id="roleId" name="role_id" data-vv-as="&quot;{{ __('admin::app.users.users.role') }}&quot;">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('role_id')">@{{ errors.first('role_id') }}</span>
                            </div>

                           
                            <div class="control-group">
                                <label for="status">{{ __('admin::app.users.users.status') }}</label>
                                
                                <label class="switch">
                                    <input type="checkbox" id="status" name="status" value="{{ $user->status }}" {{ $user->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            @if($userdetail != null)
                            <div class="control-group" id="field_profile_dsec">
                                <label for="profile_dsec" class="required">{{ __('admin::app.users.users.profile_dsec') }}</label>
                                
                                <textarea  class="control" id="profile_dsec" name="profile_dsec" data-vv-as="&quot;{{ __('admin::app.users.users.profile_dsec') }}&quot;">{{ $userdetail->profile_dsec }}</textarea>
                                <span class="control-error" id="error-profile_dsec"></span>
                            </div>

                            <div id="instructor">
                                <div class="control-group" id="class-dbs_doc_file">
                                    <label for="status">DBS Document</label>
                                    <input type="file" id="dbs_doc_file" name="dbs_doc_file" />
                                    <a href="{{ Storage::url('app/public/'.$userdetail->dbs_doc_file) }}" target="_blank">View Current Document</a>
                                    <span class="control-error" id="error-dbs_doc_file"></span>
                                    
                                </div>
                                
                                <div class="control-group" id="class-ios_cert_file">
                                    <label for="status">Ios Certificate</label>
                                    <input type="file" id="ios_cert_file" name="ios_cert_file" />
                                    <a href="{{ Storage::url('app/public/'.$userdetail->ios_cert_file) }}" target="_blank">View Current Document</a>
                                    <span class="control-error" id="error-ios_cert_file"></span>
                                  
                                </div>

                                <div class="control-group">
                                    <label for="status">Signed Contracts</label>
                                   
                                    <input type="file" id="signed_contract_file" name="signed_contract_file" />
                                    <a href="{{ Storage::url('app/public/'.$userdetail->signed_contract_file) }}" target="_blank">View Current Document</a>
                                    <span class="control-error" id="error-signed_contract_file"></span>
                                  
                                </div>

                                <div class="control-group">
                                    <label for="status">Maximum Teach Level</label>
                                   
                                    <!-- <input type="text" class="control" id="max_teach_level_name" name="max_teach_level_name" value="{{ $userdetail->max_teach_level_name }}"/> -->
                                    <select id="max_teach_level_name" name="max_teach_level_name" class="control">
                                        @foreach($levels as $level)
                                        <option value="{{ $level->id }}" @if($level->id == $userdetail->max_teach_level_name) selected @endif>{{ $level->level_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="control-error" id="error-max_teach_level_name"></span>
                                    <br>
                                    <input type="number" class="control" id="max_teach_level_stage" name="max_teach_level_stage" value="{{ $userdetail->max_teach_level_stage }}"/>
                                    <span class="control-error" id="error-max_teach_level_stage"></span>
                                  
                                </div>

                            </div>
                            <div id="branch">
                                <div class="control-group">
                                    <label for="job-title">Job Title</label>
                                    <input type="text" class="control" id="job_title" name="job_title" value="{{ $userdetail->job_title }}"/>
                                    <span class="control-error" id="error-job_title"></span>

                                </div>
                            </div>
                            @endif
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            var role = $("#roleId").val();
            if(role == 2){
                $("#instructor").show();
                $("#field_profile_dsec").show();
            }
            if(role == 3 || role == 4){
                $("#branch").show();
                $("#field_profile_dsec").show();
            }

            //validation script
            $("form#updateValidate").submit(function (e) {
                var role_id = $('#roleId').val();
                if(role_id == 2){
                    var profile_dsec = $('#profile_dsec').val();
                    if(profile_dsec == ''){
                        $('#error-profile_dsec').show();
                        $('#error-profile_dsec').html('</br>The "Profile Description" is required.');
                        
                    }else{
                        $('#error-profile_dsec').html('');
                    }

                    var doc_file = $('#max_teach_level_name').val();
                    if(doc_file == ''){
                        $('#error-max_teach_level_name').show();
                        $('#error-max_teach_level_name').html('</br>The "Level Name " is required.');
                        
                    }else{
                        $('#error-max_teach_level_name').html('');
                    }

                    var doc_file = $('#max_teach_level_stage').val();
                    if(doc_file == ''){
                        $('#error-max_teach_level_stage').show();
                        $('#error-max_teach_level_stage').html('</br>The "Level Stage " is required.');
                        
                    }else{
                        $('#error-max_teach_level_stage').html('');
                    }

                    if(profile_dsec == ''){
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

                    if(job_title == ''){
                        return false;    
                    }
                }     
            });
        });
    </script>
@endpush