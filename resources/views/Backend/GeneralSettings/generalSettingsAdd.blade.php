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
                        General Settings
                        @if(@isset($general))
                            Edit
                         @elseif(@isset($data))
                            Edit
                         @else
                            Add
                         @endif

                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item active">Add/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

              <div class="col s12">

                       <!-- warning msg show -->
                            @if($errors->any())
                               <div class="mt-5 card-alert card gradient-45deg-amber-amber">
                                <div class="card-content white-text">
                                  <p>
                                    <i class="material-icons">warning</i> Opps Something went wrong</p>
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
                                        <i class="material-icons">warning</i> Opps Something went wrong</p>
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

                @if(@isset($general) || request()->is('general/add'))
                    <!-- general settings Add -->
                    <div class="container">
                        <div class="row">
                            <form id=@if(@isset($general))'Updategeneralsettings'@else'generalsettings'@endif class="col s12" action="@if(@isset($general)){{route('general.update',Crypt::encrypt($general->id))}} @else{{route('general.store')}} @endif" method="POST">
                                 @csrf

                                @if(@isset($general))
                                 <input type="hidden" value="{{Crypt::encrypt($general->id)}}" name="hiddenVal" id="hiddenVal">
                                @endif


                                 <div class="card">
                                        <div class="card-content">
                                            <div  class="card-header col m12 s12">
                                                <h4 style="float: left;" class="General card-title">General Settings</h4>

                                                <a class="right fontawesome btn waves-effect waves-light amber darken-4" target="_blank" href="https://fontawesome.com/icons">Font Awesome Link</a>

                                                @if(@isset($general))
                                                     <a class="btn right mr-3" href="{{route('general.add')}}">Add</a>
                                                 @endif


                                            </div>


                                            <div class="row">
                                                <div class="input-field col m6 s12">
                                                    <label for="name">Name: <span class="red-text">*</span></label>
                                                    <input value="@if(@isset($general)){{$general->name}}@else{{old('name')}}@endif" id="name" name="name" type="text" class="validate" data-error=".errorname" required="">
                                                    <small class="errorname"></small>
                                                </div>

                                                <div class="input-field col m6 s12">
                                                    <label for="icon">Icon: <span class="red-text">*</span></label>
                                                    <input value="@if(@isset($general)){{$general->icon}}@else{{old('icon')}}@endif" id="icon" name="icon" type="text" class="validate" data-error=".erroricon" required="">
                                                     <small class="erroricon"></small>
                                                </div>

                                                <div class="input-field col m9 s12">

                                                    <label for="text">Text: <span class="red-text">*</span></label>
                                                    <input value="@if(@isset($general)){{$general->text}}@else{{old('text')}}@endif" id="text" name="text" type="text" class="validate" data-error=".errortext" required="">
                                                    <small class="errortext"></small>
                                                </div>

                                                @if(@$general->header_top_position==0)
                                                 <div class="input-field col m3 s12">
                                                    <select class="validate" name="status" id="status" data-error=".errorStatus" required="">

                                                    <option  value="" >Select Status</option>
                                                    <option  @if(@isset($general))   {{($general->status==1)?'selected':''}} @else {{ old('status') == 'active' ? "selected" : "" }} @endif  value="active">Active</option>

                                                    <option  @if(@isset($general)) {{($general->status==0)?'selected':''}} @else {{ old('status') == 'inactive' ? "selected" : "" }} @endif  value="inactive">Inactive</option>

                                                    </select>
                                                    <label>Status: <span class="red-text">*</span></label>
                                                    <small class="errorStatus"></small>
                                                </div>
                                                @endif


                                            </div>


                                            <div class="row"
                                                <div class="col m4 s12 submit">
                                                    <button id="submit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> @if(@isset($general)) Update @else Submit @endif
                                                    </button>
                                                </div>
                                            </div>
                                  </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <!-- general settings Add End-->
                @endif

                @if(@isset($data) || request()->is('general/add'))
                  <!-- Social Media settings Add -->
                    <div class="container">
                        <div class="row">
                            <form id=@if(@isset($data))'Updatesocialsettings'@else'socialsettings'@endif class="col s12" action="@if(@isset($data)){{route('social.update',Crypt::encrypt($data->id))}} @else{{route('social.store')}} @endif" method="POST"  >
                                 @csrf

                                @if(@isset($data))
                                 <input type="hidden" value="{{Crypt::encrypt($data->id)}}" name="hiddenVal" id="hiddenVal">
                                @endif

                                 <div class="card">
                                        <div class="card-content">
                                            <div  class="card-header col m12 s12">
                                                <h4 style="float: left;" class="General card-title">Social Media settings</h4>

                                                <a class="right fontawesome btn waves-effect waves-light amber darken-4" target="_blank" href="https://fontawesome.com/icons">Font Awesome Link</a>



                                                @if(@isset($data))
                                                     <a class="btn right mr-3" href="{{route('general.add')}}">Add</a>
                                                 @endif


                                            </div>


                                            <div class="row">
                                                <div class="input-field col m6 s12">
                                                    <label for="socialname">Name: <span class="red-text">*</span></label>
                                                    <input value="@if(@isset($data)){{$data->name}}@else{{old('socialname')}}@endif" id="socialname" name="socialname" type="text" class="validate" data-error=".errorsocialname" required="">
                                                    <small class="errorsocialname"></small>
                                                </div>

                                                <div class="input-field col m6 s12">
                                                    <label for="socialicon">Icon: <span class="red-text">*</span></label>
                                                    <input value="@if(@isset($data)){{$data->icon}}@else{{old('socialicon')}}@endif" id="socialicon" name="socialicon" type="text" class="validate" data-error=".errorsocialicon" required="">
                                                    <small class="errorsocialicon"></small>
                                                </div>

                                                <div class="input-field col m9 s12">

                                                    <label for="url">url: <span class="red-text">*</span></label>
                                                    <input value="@if(@isset($data)){{$data->url}}@else{{old('url')}}@endif" id="url" name="url" type="url" class="validate" data-error=".errorurl" required="">
                                                    <small class="errorurl"></small>
                                                </div>

                                                @if(@$data->position_customize==0)
                                                 <div class="input-field col m3 s12">
                                                    <select class="validate" name="socialstatus" id="socialstatus" data-error=".errorsocialstatus" required="">

                                                    <option value="" selected>Select Status</option>
                                                    <option @if(@isset($data)) {{($data->status==1)?'selected':''}} @else {{ old('socialstatus') == 'active' ? "selected" : "" }} @endif  value="active">Active</option>

                                                    <option @if(@isset($data)) {{($data->status==0)?'selected':''}} @else {{ old('socialstatus') == 'inactive' ? "selected" : "" }} @endif  value="inactive">Inactive</option>

                                                    </select>
                                                    <label>Status: <span class="red-text">*</span></label>
                                                    <small class="errorsocialstatus"></small>
                                                </div>
                                                @endif



                                            </div>


                                            <div class="row"
                                                <div class="col m4 s12 submit">
                                                    <button id="submit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> @if(@isset($data)) Update @else Submit @endif
                                                    </button>
                                                </div>
                                            </div>
                                  </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    <!-- Social Media settings End-->
                @endif

              </div>




        </div>
    </div>
      <!-- END: Page Main-->
@endsection
