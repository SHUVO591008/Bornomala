@extends('layouts.BackendLayout')

@section('content')

<style>
    .tox{
        height: 654px!important;
    }
</style>

<script>
  tinyMCE.init({

    relative_urls : false,
    remove_script_host: true,
});

  </script>

<?php

$Settings = App\Model\Settings::first();
?>

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
                        Gmail Send
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Gmail send Processing
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

           
              <div class="col s12">
                <!-- Gmail settings Add -->
                <div class="container">
                    <div class="row">
                      @php $UserID= Crypt::encrypt($data->id); @endphp

                        <form id="gmailSettingsettings" class="col s12" action="{{route('gmail.store',$UserID)}}" method="POST" enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                             <h4 style="float: left;" class="General card-title">Gmail send Processing</h4>
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


                                   

                                            <div class="input-field col m12 s12">
                                                <label for="gmail_from">To<span class="red-text">*</span></label>
                                                <input value="{{ $data->email }}" id="gmail_from" name="gmail_from" type="text" data-error=".errorgmail_from" readonly required>
                                                <small class="errorgmail_from"></small>
                                            </div>

                                            <div class="input-field col m12 s12 mb-2">
                                                <label for="gmail_from">Message<span class="red-text"></span></label>
                                            </div>

                                            <div class="input-field col m12 s12">
                                                <textarea id="mytextarea" class="mytextarea validate" id="mytextarea" name="mytextarea" data-error=".errormytextarea" placeholder="Message Body..." >
                                                    <img width="50" height="50" alt="logo" src="{{ asset($Settings->logo) }}">

                                                   
                                                    <br>
                                                    <br>
                                                    Dear Student,
                                                    <br>
                                                    <br>
                                                    <b>Your Information Here</b><br>
                                                    ----------------------------
                                                    <br>
                                                    <table style="text-align: center;border-collapse: collapse;">
                                                          <tr>
                                                            <th style="border: 1px solid;padding: 10px;">UserID</th>
                                                            <th style="border: 1px solid;padding: 10px;">UserName</th>
                                                            <th style="border: 1px solid;padding: 10px;">Name</th>
                                                            <th style="border: 1px solid;padding: 10px;">Email</th>
                                                            <th style="border: 1px solid;padding: 10px;">Mobile</th>
                                                            <th style="border: 1px solid;padding: 10px;">Gender</th>
                                                            <th style="border: 1px solid;padding: 10px;">Status</th>
                                                            <th style="border: 1px solid;padding: 10px;">Admission Class</th>
                                                            <th style="border: 1px solid;padding: 10px;">Section</th>
                                                          </tr>
                                                          <tr>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->student_id }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->user_name }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->first_name }}  {{ $data->last_name }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->email }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->mobile }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->gender }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->status }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->class }}
                                                            </td>
                                                            <td style="border: 1px solid;padding: 10px;">
                                                                {{ $data->section }}
                                                            </td>
                                                          </tr>
                                                    </table>


                                                    <b>Message</b><br>
                                                    ----------------
                                                  
                                                 
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    Sincerely,
                                                    <br>
                                                    <br>
                                                    <b>{{ $Settings->name }}</b>
                                                    <br>
                                                    Website Link: <a target="_blank" href="{{ URL::to('/') }}">{{ URL::to('/') }} </a>

                                                 
                                                </textarea>
                                              <small id="gamilValid" class="gamilValid"></small>
                                          </div>


            

                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="gmailSettingsubmit" class="waves-effect waves-dark btn btn-primary btnSubmit" type="submit">  Send
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