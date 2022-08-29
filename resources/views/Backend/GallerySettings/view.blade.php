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
                            <span>Image gallery</span>
                            </h5>
                        </div>

                        <div class="col s12 m6 l6 right-align-md">
                          <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active">Image
                            </li>
                          </ol>
                        </div>

                      </div>
                </div>
            </div>

            <!-- gallary-->
            <section class="gallary-section">
                <div class="container">
                <div class="row">

                    <div class="title-div card ">
                        <div  class="card-header col m12 s12">
                            <h4 style="text-align: center;background: yellowgreen;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Image Gallery</h4>
                            <hr>
                        </div>

                        <div  class="col card-text float-right  mt-3">
                            <a class="btn btn-sm btn-info" href="{{ url()->previous() }}"><i class="fa fa-backward"></i> &nbsp; Back</a>
                            <a class="btn btn-sm btn-success" href="{{ route('gallery.add') }}"><i class="fa fa-adjust"></i> &nbsp; Add Image</a>
                        </div>

                         <div  class="card-header col m12 s12 mt-2">
                            <h4 style="text-align: center;background: #6246ff;color: white;padding: 10px;    font-weight: 700;" class="General card-title ">Group Name : {{$data[0]->group_name}}</h4>
                            <hr>
                        </div>
                    </div>

                      <div style="width: 100%;" class="col m12 s12" id="frame">
                        <div class="gallery js-gallery">
                            @foreach($data as $image)
                                <div>
                                  
                                    <a  href="{{ asset($image->image)}}" rel="{{$image->slug}}" title="{{$image->group_name}}">
                                        <img class="mt-3" src="{{ asset($image->image)}}?h=200">
                                    </a>
                                </div>
                            @endforeach


                      

                        </div>
                      </div>


                       

                    <div class="col card-text mt-2 float-right">

                        <a class="btn-floating waves-effect waves-light amber darken-4" href="{{route('gallery.edit',$data[0]->slug)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                        <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('gallery.delete',$data[0]->slug) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i>
                        </a>

                
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
        @foreach($data as $image)
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