@extends('layouts.BackendLayout')

@section('content')
<!-- gallary -->
    <link rel="stylesheet" media="screen" href="{{asset('Frontend/css/common.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('Frontend/css/reset.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="{{asset('Frontend/js/gallery.js')}}"></script>
    <script src="{{asset('Frontend/js/gallery.dev.js')}}"></script>


  <!-- gallary -->


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
                       Image Edit
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Image Edit/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

              <div class="col s12">
                <!-- gallery settings Edit -->
                <div class="container">
                    <div class="row">
                        <form id="galleryEditsettings" class="col s12" action="{{route('gallery.update',$edit[0]->slug)}}" method="POST" enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">Gallery Settings</h4>

                                 
                                        </div>
                                    <!-- warning msg show -->
                                    @if($errors->any())
                                       <div class="mt-5 card-alert card gradient-45deg-amber-amber">
                                        <div class="card-content white-text">
                                          <p>
                                            <i class="material-icons">warning</i> Opps! Something went wrong.</p>
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
                                                <i class="material-icons">warning</i> Opps!Something went wrong.</p>
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
                                             <div class="input-field col m6 s12">
                                                <label for="group_name">Group Name: <span class="red-text">*</span></label>
                                                <input value="{{$edit[0]->group_name}}" id="group_name" name="group_name" type="text" class="validate" data-error=".errorgroup_name" required="">
                                                <small class="errorgroup_name"></small>
                                            </div>

                                            <input style="display:none" value="{{$edit[0]->slug}}" id="slug" name="slug" type="text" class="validate" data-error=".errorslug" required="">


                                             <div class="input-field file-field col m6 s12">
                                                <div class="btn float-right">
                                                  <span>Image: </span><span class="red-text">*</span>
                                                  <input name="image[]" type="file" accept="image/*" multiple>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input name="image[]" class="file-path validate" type="text" required="" data-error=".errorImage" accept="image/*" multiple>
                                                     <small style="display: none;" class="errorImage"></small>
                                                </div>
                                            </div>


                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="submit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> Update
                                                </button>
                                            </div>
                                        </div>
                              </div>
                          </div>
                        </form>
                    </div> 
                </div>
                <!-- gallery settings Add End-->
              </div>


            <!-- gallary-->
            <section class="gallary-section">
                <div class="container">
                <div class="row">

                    <div class="title-div card ">
                       

                        <div  class="col card-text float-right  mt-3">
                            <a class="btn btn-sm btn-info" href="{{ url()->previous() }}"><i class="fa fa-backward"></i> &nbsp; Back</a>
                            <a class="btn btn-sm btn-success" href="{{ route('gallery.add') }}"><i class="fa fa-adjust"></i> &nbsp; Add Image</a>
                        </div>

                         <div  class="card-header col m12 s12 mt-2">
                            <h4 style="text-align: center;background: #6246ff;color: white;padding: 10px;    font-weight: 700;" class="General card-title ">Old Image</h4>
                            <hr>
                        </div>
                    </div>

                      <div style="width: 100%;" class="col m12 s12" id="frame">
                        <div class="gallery js-gallery">
                            @foreach($edit as $image)
                                <div>
                                  
                                    <a  href="{{ asset($image->image)}}" rel="{{$image->slug}}" title="{{$image->group_name}}">
                                        <img class="mt-3" src="{{ asset($image->image)}}?h=200">
                                    </a>
                                </div>
                            @endforeach


                      

                        </div>
                      </div>


                       

                     
                </div>

                </div>
            </section>
            <!-- //gallary-->

       

        </div>
    </div>
      <!-- END: Page Main-->

<!-- gallary-->
    <script>
    var gallery_init = {

      group : [
        @foreach($edit as $image)
          '<?php echo $image->slug?>',
        @endforeach
      ],
      //set_svg_color : '#ff6666',
      //set_image_hover_transparency : false
    };

    $(gallery.construct(gallery_init));
    </script>
<!-- gallary-->
@endsection