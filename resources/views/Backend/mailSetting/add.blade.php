@extends('layouts.BackendLayout')

@section('content')



<!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">

         
          <div id="breadcrumbs-wrapper" data-image="{{asset("Backend/app-assets/images/gallery/breadcrumb-bg.jpg")}}">
                <!-- Search for small screen-->
                <div class="container">
                  <div class="row">

                    <div class="col s12 m6 l6">
                      <h5 class="breadcrumbs-title mt-0 mb-0">
                        <span>
                        Mail Settings
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Mail Setting Show/Add
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

           
              <div class="col s12">
                <!-- mailSetting settings Add -->
                <div class="container">
                    <div class="row">

                        <form id="mailSettingsettings" class="col s12" action="@if(@isset($mailsettings)){{route('mailSetting.update')}} @else{{route('mailSetting.store')}} @endif" method="POST" >
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                             <h4 style="float: left;" class="General card-title"> Mail Settings</h4>
                                        </div>
                                    <!-- warning msg show -->
                                    @if($errors->any())
                                       <div class="mt-5 card-alert card gradient-45deg-amber-amber">
                                        <div class="card-content white-text">
                                          <p>
                                            <i class="material-icons">warning</i> Opps! Something went wrong</p>
                                            <ul>
                                                <ol>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ol>
                                            </ul>
                                        </div>

                                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                      </div>
                                    @endif
                                    

                                    @if(session()->has('msg'))
                                         <div class="mt-5 card-alert card gradient-45deg-amber-amber">
                                            <div class="card-content white-text">
                                              <p>
                                                <i class="material-icons">warning</i> Opps! Something went wrong</p>
                                                <ul>
                                                    <ol>
                                                        {{ session()->get('msg') }}
                                                    </ol>
                                                </ul>
                                            </div>

                                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                    @endif

                                    <!-- warning msg show End-->

                                        <div class="row">


                                            <div class="input-field col m6 s6">
                                                <label for="mail_transport">Mail Transport<span class="red-text">*</span></label>
                                                <input value="@if(@isset($mailsettings)){{$mailsettings->mail_transport}}@else{{old('mail_transport')}}@endif" id="mail_transport" name="mail_transport" type="text" data-error=".errormail_transport">
                                                <small class="errormail_transport"></small>
                                            </div>

                                             <div class="input-field col m6 s6">
                                                <label for="mail_host">Mail Host<span class="red-text">*</span></label>
                                                <input value="@if(@isset($mailsettings)){{$mailsettings->mail_host}}@else{{old('mail_host')}}@endif" id="mail_host" name="mail_host" type="text" data-error=".errormail_host">
                                                <small class="errormail_host"></small>
                                            </div>

                                             <div class="input-field col m6 s6">
                                                <label for="mail_port">Mail Port<span class="red-text">*</span></label>
                                                <input value="@if(@isset($mailsettings)){{$mailsettings->mail_port}}@else{{old('mail_port')}}@endif" id="mail_port" name="mail_port" type="text" data-error=".errormail_port">
                                                <small class="errormail_port"></small>
                                            </div>

                                             <div class="input-field col m6 s6">
                                                <label for="mail_username">Mail Username<span class="red-text">*</span></label>
                                                <input value="@if(@isset($mailsettings)){{$mailsettings->mail_username}}@else{{old('mail_username')}}@endif" id="mail_username" name="mail_username" type="text" data-error=".errormail_username">
                                                <small class="errormail_username"></small>
                                            </div>

                                             <div class="input-field col m6 s6">
                                                <label for="mail_password">Mail Password<span class="red-text">*</span></label>
                                                <input value="@if(@isset($mailsettings)){{$mailsettings->mail_password}}@else{{old('mail_password')}}@endif" id="mail_password" name="mail_password" type="text" data-error=".errormail_password">
                                                <small class="errormail_password"></small>
                                            </div>

                                             <div class="input-field col m6 s6">
                                                <label for="mail_encryption">Mail Encryption<span class="red-text">*</span></label>
                                                <input value="@if(@isset($mailsettings)){{$mailsettings->mail_encryption}}@else{{old('mail_encryption')}}@endif" id="mail_encryption" name="mail_encryption" type="text" data-error=".errormail_encryption">
                                                <small class="errormail_encryption"></small>
                                            </div>

                                            <div class="input-field col m12 s12">
                                                <label for="mail_from">Mail From<span class="red-text">*</span></label>
                                                <input value="@if(@isset($mailsettings)){{$mailsettings->mail_from}}@else{{old('mail_from')}}@endif" id="mail_from" name="mail_from" type="text" data-error=".errormail_from">
                                                <small class="errormail_from"></small>
                                            </div>


            

                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="mailSettingsubmit" class="waves-effect waves-dark btn btn-primary btnSubmit" type="submit"> @if(@isset($mailsettings)) Update @else Submit @endif
                                                </button>
                                            </div>
                                        </div>
                              </div>
                          </div>
                        </form>


                    </div> 
                </div>
                <!-- mailSetting settings Add End-->
              </div>
         

        </div>
    </div>
      <!-- END: Page Main-->



@endsection