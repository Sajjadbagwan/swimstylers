@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.users.users.add-user-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" id="test" action="{{ route('admin.users.store') }}"  enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.users.users.add-user-title') }}
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

                    <accordian :title="'{{ __('admin::app.users.users.general') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('admin::app.users.users.name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('admin::app.users.users.name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>

                                <!-- <span class="control-error" id="error-name"></span> -->
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required">{{ __('admin::app.users.users.email') }}</label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" data-vv-as="&quot;{{ __('admin::app.users.users.email') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>

                                <!-- <span class="control-error" id="error-email"></span> -->
                            </div>

                            <div class="control-group" :class="[errors.has('contact_number') ? 'has-error' : '']">
                                <label for="contact-number" class="required">{{ __('admin::app.users.users.contact_number') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="contact_number" name="contact_number" data-vv-as="&quot;{{ __('admin::app.users.users.contact_number') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('contact_number')">@{{ errors.first('contact_number') }}</span>
                            </div>
                            
                            <div class="control-group">
                                <label for="status">Profile Photo</label>
                                <input type="file" id="image" name="image" class="control"/>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'{{ __('Password') }}'" :active="true">
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
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('role_id')">@{{ errors.first('role_id') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status">{{ __('admin::app.users.users.status') }}</label>
                               
                                <label class="switch">
                                    <input type="checkbox" id="status" name="status" value="1" {{ old('status') ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            
                            <div class="control-group" id="field_profile_dsec">
                                <label for="profile_dsec" class="required">{{ __('admin::app.users.users.profile_dsec') }}</label>
                                <!-- <input type="text" class="control" id="profile_dsec" name="profile_dsec" data-vv-as="&quot;{{ __('admin::app.users.users.profile_dsec') }}&quot;"/> -->
                                <textarea  class="control" id="profile_dsec" name="profile_dsec" data-vv-as="&quot;{{ __('admin::app.users.users.profile_dsec') }}&quot;"></textarea>
                                <span class="control-error" id="error-profile_dsec"></span>
                            </div>

                            <div id="instructor">
                                <div class="control-group" id="class-dbs_doc_file">
                                    <label for="status">DBS Document</label>
                                    <input type="file" id="dbs_doc_file" name="dbs_doc_file" />
                                    <span class="control-error" id="error-dbs_doc_file"></span>
                                  
                                </div>
                                
                                <div class="control-group" id="class-ios_cert_file">
                                    <label for="status">Ios Certificate</label>
                                    <input type="file" id="ios_cert_file" name="ios_cert_file" />
                                    <span class="control-error" id="error-ios_cert_file"></span>
                                  
                                </div>

                                <div class="control-group">
                                    <label for="status">Signed Contracts</label>
                                   
                                    <input type="file" id="signed_contract_file" name="signed_contract_file" />
                                    <span class="control-error" id="error-signed_contract_file"></span>
                                  
                                </div>

                                <div class="control-group">
                                    <label for="status">Maximum Teach Level</label>
                                   
                                    <select id="max_teach_level_name" name="max_teach_level_name" class="control">
                                        @foreach($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->level_name }}</option>
                                        @endforeach
                                    </select>

                                    <span class="control-error" id="error-max_teach_level_name"></span>
                                    <br>
                                    <input type="number" class="control" id="max_teach_level_stage" name="max_teach_level_stage" />
                                    <span class="control-error" id="error-max_teach_level_stage"></span>
                                  
                                </div>
                            </div>

                            <div id="branch">
                                <div class="control-group">
                                    <label for="job-title">Job Title</label>
                                    <input type="text" class="control" id="job_title" name="job_title" />
                                    <span class="control-error" id="error-job_title"></span>

                                </div>
                            </div>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop