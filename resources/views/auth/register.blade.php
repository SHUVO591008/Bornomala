<?php
$logo = App\Model\Settings::first();


?>

<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="SHUVO">
    <title>Register </title>

        <link rel="apple-touch-icon" href="{{($logo==null)?'':asset($logo->favicon)}}">
       <link style="height: 16px;width: 16px;" rel="shortcut icon" type="image/png" href="{{($logo==null)?'':asset($logo->favicon)}}">
    
    <link href="{{ asset("Backend/icon.css?family=Material+Icons")}}" rel="stylesheet">

    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("Backend/app-assets/vendors/vendors.min.css")}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("Backend/app-assets/css/themes/vertical-dark-menu-template/materialize.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("Backend/app-assets/css/themes/vertical-dark-menu-template/style.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("Backend/app-assets/css/pages/register.min.css")}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("Backend/app-assets/css/custom/custom.css")}}">
    <!-- END: Custom CSS-->





      <style>
      
        .registration_img {
            width: 50%;
            display: block;
            margin-left: auto;
             margin-right: auto; 

        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }

    </style>


  </head>
  <!-- END: Head-->
  <body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu preload-transitions 1-column register-bg   blank-page blank-page" data-open="click" data-menu="vertical-dark-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container"><div id="register-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">

    <!-- warning msg show -->
            @if($errors->any())
               <div class="mt-5 card-alert card gradient-45deg-amber-amber">
                <div class="card-content white-text">
                  <p>
                    <i class="material-icons">warning</i> Opps !</p>
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
                        <i class="material-icons">warning</i> Opps !</p>
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

    <form id="registration_form" class="register-form" method="POST" action="{{ route('register') }}">
       @csrf

      <div class="row">
        <div class="input-field col s12">
          <img class="registration_img" src="{{asset("Backend/registration_image/registration.jpg")}}">
          <h5 class="ml-4">Register</h5>
          <p class="ml-4">Join to our community now !</p>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="username" type="text" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
          <label for="username" class="center-align">Username</label>
        </div>
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">mail_outline</i>
          <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email">
          <label for="email">Email</label>
        </div>
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">phone_iphone</i>
          <input id="mobile" type="number" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">
          <label for="mobile">Mobile</label>
        </div>
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" name="password" required autocomplete="new-password">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
          <label for="password_confirmation">Password again</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">

          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                Register
          </button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <p class="margin medium-small"><a href="{{route('login')}}">Already have an account? Login</a></p>
        </div>
      </div>
    </form>
  </div>
</div>
        </div>
        <div class="content-overlay"></div>
      </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset("Backend/app-assets/js/vendors.min.js")}}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset("Backend/app-assets/js/plugins.min.js")}}"></script>
    <script src="{{asset("Backend/app-assets/js/search.min.js")}}"></script>
    <script src="{{asset("Backend/app-assets/js/custom/custom-script.min.js")}}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
     <script src="{{ asset("Backend/app-assets/js/scripts/ui-alerts.min.js")}}"></script>
    <!-- END PAGE LEVEL JS-->

       <!-- Custom js -->

     <script src="{{ asset("Backend/app-assets/js/validate.js")}}"></script>
  <!--/ Custom js -->



  </body>
</html>