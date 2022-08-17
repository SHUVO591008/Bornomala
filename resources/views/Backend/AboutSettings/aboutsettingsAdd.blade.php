@extends('layouts.BackendLayout')

@section('content')

<?php
use App\Model\about;
$sl = 1;
$about = about::all();


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
                        About Settings @if(@isset($data)) Edit @else Add @endif
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">About settings Add/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

            @if($about->isEmpty())
              <div class="col s12">
                <!-- about settings Add -->
                <div class="container">
                    <div class="row">

                        <form id="aboutsettings" class="col s12" action="@if(@isset($data)){{route('about.update',Crypt::encrypt($data->id))}} @else{{route('about.store')}} @endif" method="POST"  enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">About Settings</h4>

                                        </div>
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

                                        <div class="row">
                                             
                                           <div class="input-field col m12 s12">
                                                <label for="title">Title: <span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->title}}@else{{old('title')}}@endif" id="title" name="title" type="text" data-error=".errortitle">
                                                <small class="errortitle"></small>
                                            </div>

                                            <div class="input-field col m12 s12">
                                                  <textarea id="mytextarea" class="mytextarea validate" id="mytextarea" name="mytextarea" data-error=".errormytextarea" placeholder="Describe here..." >@if(@isset($data)){{$data->text}}@else{{old('mytextarea')}}@endif</textarea>
                                                <small id="questionValid" class="questionValid"></small>
                                            </div>

            

                                            <div class="input-field file-field col m6 s12">
                                                <div class="btn float-right">
                                                  <span>Image: </span><span class="red-text">*</span>
                                                  <input class="upload" name="image" type="file" accept="image/*" onchange="readURL(this);">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input name="image" class="file-path validate upload" type="text" required="" data-error=".errorImage" accept="image/*" onchange="readURL(this);">
                                                     <small style="display: none;" class="errorImage"></small>
                                                </div>

                                            </div>

                                            <div class="input-field col m6 s12">
                                                <div class="float-right">
                                                    <img style="max-width: 100%;width:100%" id="image" src="{{asset('Backend/Extra_image/no_image.jpg')}}" />
                                                </div>
                                            </div>                    

                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="aboutsubmit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> @if(@isset($data)) Update @else Submit @endif
                                                </button>
                                            </div>
                                        </div>
                              </div>
                          </div>
                        </form>


                    </div> 
                </div>
                <!-- about settings Add End-->
              </div>
            @endif

            @if(@isset($data))
              <div class="col s12">
                <!-- about settings Add -->
                <div class="container">
                    <div class="row">

                        <form id="aboutsettings" class="col s12" action="@if(@isset($data)){{route('about.update',Crypt::encrypt($data->id))}} @else{{route('about.store')}} @endif" method="POST"  enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">About Settings</h4>
                                        </div>
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

                                        <div class="row">
                                             
                                           <div class="input-field col m12 s12">
                                                <label for="title">Title: <span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->title}}@else{{old('title')}}@endif" id="title" name="title" type="text" data-error=".errortitle">
                                                <small class="errortitle"></small>
                                            </div>

                                            <div class="input-field col m12 s12">
                                                  <textarea id="mytextarea" class="mytextarea validate" id="mytextarea" name="mytextarea" data-error=".errormytextarea" placeholder="Describe here..." >@if(@isset($data)){{$data->text}}@else{{old('mytextarea')}}@endif</textarea>
                                                <small id="questionValid" class="questionValid"></small>
                                            </div>

           

                                            <div class="input-field file-field col m6 s12">

                                           
                                                <div class="btn float-right">
                                                  <span>Image: </span><span class="red-text">*</span>
                                                  <input class="upload" name='{{(isset($data))?"oldImage":"image"}}' type="file" accept="image/*" onchange="readURL(this);">
                                                </div>

                                                <div class="file-path-wrapper">
                                                    <input name="{{(isset($data))?"oldImage":"image"}}" class="file-path @if(@isset($data)) @else validate @endif  upload" type="text" required="" data-error=".errorImage" accept="image/*" onchange="readURL(this);">
                                                     <small style="display: none;" class="errorImage"></small>
                                                </div>

                                            </div>

                                            <div class="input-field col m6 s12">
                                                <div class="float-right">
                                                    <img style="max-width: 100%;width:100%" id="image" src="@if(@isset($data)) {{asset($data->image)}} @else {{asset('Backend/Extra_image/no_image.jpg')}} @endif" />
                                                </div>
                                            </div>                    

                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="aboutsubmit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> @if(@isset($data)) Update @else Submit @endif
                                                </button>
                                            </div>
                                        </div>
                              </div>
                          </div>
                        </form>


                    </div> 
                </div>
                <!-- about settings Add End-->
              </div>
            @endif



            <!-- about settings show-->
              <!-- Responsive Table -->
              @if($about->isNotEmpty())
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">About Settings Show
                               
                                </h4>
                               
                                <hr>
                            </div>
                          <div class="row">
                            <div class="col s12">
                            </div>
                            <div class="col s12">
                              <table class="responsive-table centered bordered">
                                <thead>
                                  <tr>
                                      <th data-field="sl">Sl</th>
                                      <th data-field="title">Title</th>
                                      <th data-field="text">Text</th>
                                      <th data-field="image">Image</th>
                                      <th data-field="published">Status</th>
                                      <th data-field="created_by">Created by</th>
                                      <th data-field="updated_by">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($about)==0)
                                        <td colspan="7">No Data Found</td>
                                    @else
                                        @foreach($about as $key)
                                            @php $prodID= Crypt::encrypt($key->id); @endphp
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td style="width:20%">
                                                <?php echo str_Limit(strip_tags($key->title),80)?>
                                              </td>
                                              <td style="width:30%">
                                                  <?php echo str_Limit(strip_tags($key->text),100)?>
                                
                                                @if (strlen(strip_tags($key->text)) > 101)
                                                    <a href="{{ route('about.view',$prodID) }}" class="waves-effect waves-light btn-small mb-1 mr-1 mt-3">Read More..</a>
                                                @endif


                                                    
                                              </td>
                                              <td style="width:8%">
                                                <img style="max-width:100%" src="{{asset($key->image)}}">
                                                
                                              </td>
                                              <td style="width:20%">
                                                  <div class="switch">
                                                    <label>
                                                      <span>Unpublished</span>
                                                      <input data-column="{{route('about.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
                                                      <span class="lever"></span>
                                                      <span>Published</span> 
                                                    </label>
                                                  </div>
                                              </td>
                                              <td style="text-transform: capitalize;">
                                                @if($key->created_by==NULL)
                                                    N/A
                                                @else
                                                    @if($key->createduser==NULL)
                                                        <p style="color: red" >Wrong User</p>
                                                    @else
                                                        {{$key->createduser->first_name}} {{$key->createduser->last_name}}
                                                    @endif
                                                @endif
                                             </td>
                                              <td style="text-transform: capitalize;">
                                                @if($key->updated_by==NULL)
                                                    <span class="updated_by">N/A</span>
                                                @else
                                                    @if($key->updateuser==NULL)
                                                        <span class="updated_by" style="color: red" >Wrong User</span>
                                                    @else
                                                        <span class="updated_by">{{$key->updateuser->first_name}} {{$key->updateuser->last_name}}
                                                        </span>
                                                    @endif
                                                @endif
                                               
                                              </td>
                                              <td  style="width:15%">
                                                 <a class="btn-floating waves-effect waves-light amber darken-3 mr-5" href="{{route('about.view',$prodID)}}" title="View"><i style="font-size: 14px;" class="fa-solid fa-eye"></i></a>

                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('about.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('about.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
                                              </td>
                                           </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               @endif
            <!-- header settings show End-->
        </div>
    </div>
      <!-- END: Page Main-->

 <!-- Image Live Show-->
<script type="text/javascript">
    function readURL(input){
       
        if(input.files.length==1){

            if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                .attr('src',e.target.result)
                .width(547)
                .height(547);
                };
                reader.readAsDataURL(input.files[0]);
            }

        }else{
            var loadImage =  '<?php echo asset("Backend/Extra_image/no_image.jpg") ?>';
            $('#image')
            .attr('src',loadImage)
            .width(547)
            .height(547);
                   
        }

      

        
    }
</script>

@endsection