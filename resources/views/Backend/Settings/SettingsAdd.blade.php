@extends('layouts.BackendLayout')

@section('content')



<?php
use App\Model\settings;
$sl = 1;
$settings = settings::get();


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
                      	Website Basic Settings
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Basic settings Add/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

     
              <div class="col s12">
                <!-- settings settings Add -->
                <div class="container">
                    <div class="row">

                        @if(count($settings)<=0)
                            <form id='Basicsettings' class="col s12" action="{{route('settings.store')}}" method="POST"  enctype="multipart/form-data">
                                 @csrf
                                 <div class="card">
                                        <div class="card-content">
                                            <div  class="card-header col m12 s12">
                                                <h4 style="float: left;" class="General card-title">Website Basic Settings</h4>
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
                                                 
                                               <div class="input-field col m4 s12 l4">
                                                    <label for="name">Website Name: <span class="red-text">*</span></label>
                                                    <input value="{{old('name')}}" id="name" name="name" type="text" data-error=".errorname">
                                                    <small class="errorname"></small>
                                                </div>


                                                <div class="input-field file-field col m4 s12 l4">
                                                    <div class="btn float-right">
                                                      <span>Logo: </span><span class="red-text">*</span>
                                                      <input class="upload" name="logo" type="file" accept="image/*" onchange="readURL(this);">
                                                    </div>

                                                    <div class="file-path-wrapper">
                                                        <input name="logo" class="file-path validate upload" type="text" required="" data-error=".errorLogo" accept="image/*" onchange="readURL(this);">
                                                         <small style="display: none;" class="errorLogo"></small>
                                                    </div>

                                                </div>


                                                <div class="input-field file-field col m4 s12 l4">
                                                    <div class="btn float-right">
                                                      <span>Favicon: </span><span class="red-text">*</span>
                                                      <input class="upload" name="favicon" type="file" accept="image/*" onchange="faviconImage(this);">
                                                    </div>

                                                    <div class="file-path-wrapper">
                                                        <input name="favicon" class="file-path validate upload" type="text" required="" data-error=".errorfavicon" accept="image/*" onchange="faviconImage(this);">
                                                         <small style="display: none;" class="errorfavicon"></small>
                                                    </div>

                                                </div>

                                                <div class="col m12 l12 s12"></div>


                                                <div class="col m4 s4 l4">
                                                	
                                                </div>



                                                <div class="input-field col m4 s4 l4">
                                                    <div style="text-align: center;" class="">
                                                        <img style="max-width: 50%;width:50%;" id="logo" src="{{asset('Backend/Extra_image/no_image.jpg')}}" />
                                                    </div>
                                                </div> 


                                                <div class="input-field col m4 s4 l4">
                                                    <div style="text-align: center;" class="">
                                                        <img style="max-width: 50%;width:50%;" id="favicon" src="{{asset('Backend/Extra_image/no_image.jpg')}}" />
                                                    </div>
                                                </div>                     

                                            </div>

                                          
                                            <div class="row"
                                                <div class="col m4 s12 submit">
                                                    <button id="aboutsubmit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> Submit
                                                    </button>
                                                </div>
                                            </div>
                                  </div>
                              </div>
                            </form>
                        @endif


                        @if(@isset($data))

                            <form id='Updatesettings' class="col s12" action="{{route('settings.update',Crypt::encrypt($data->id))}}" method="POST"  enctype="multipart/form-data">
                                 @csrf
                                 <div class="card">
                                        <div class="card-content">
                                            <div  class="card-header col m12 s12">
                                                <h4 style="float: left;" class="General card-title">Website Basic Settings Edit</h4>
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
                                                 
                                               <div class="input-field col m4 s12 l4">
                                                    <label for="name">Website Name: <span class="red-text">*</span></label>
                                                    <input value="@if(@isset($data)){{$data->name}}@else{{old('name')}}@endif" id="name" name="name" type="text" data-error=".errorname">
                                                    <small class="errorname"></small>
                                                </div>


                                                <div class="input-field file-field col m4 s12 l4">
                                                    <div class="btn float-right">
                                                      <span>Logo: </span><span class="red-text"></span>
                                                      <input class="upload" name="logo" type="file" accept="image/*" onchange="readURL(this);">
                                                    </div>

                                                    <div class="file-path-wrapper">
                                                        <input name="logo" class="file-path validate upload" type="text" required="" data-error=".errorLogo" accept="image/*" onchange="readURL(this);">
                                                         <small style="display: none;" class="errorLogo"></small>
                                                    </div>

                                                </div>


                                                <div class="input-field file-field col m4 s12 l4">
                                                    <div class="btn float-right">
                                                      <span>Favicon: </span><span class="red-text"></span>
                                                      <input class="upload" name="favicon" type="file" accept="image/*" onchange="faviconImage(this);">
                                                    </div>

                                                    <div class="file-path-wrapper">
                                                        <input name="favicon" class="file-path validate upload" type="text" required="" data-error=".errorfavicon" accept="image/*" onchange="faviconImage(this);">
                                                         <small style="display: none;" class="errorfavicon"></small>
                                                    </div>

                                                </div>

                                                <div class="col m12 l12 s12"></div>


                                                <div class="col m4 s4 l4">
                                                    
                                                </div>



                                                <div class="input-field col m4 s4 l4">
                                                    <div style="text-align: center;" class="">
                                                        <img style="max-width: 50%;width:50%;" id="logo" src="@if(@isset($data)) {{asset($data->logo)}} @else {{asset('Backend/Extra_image/no_image.jpg')}} @endif" />
                                                    </div>
                                                </div> 


                                                <div class="input-field col m4 s4 l4">
                                                    <div style="text-align: center;" class="">
                                                        <img style="max-width: 50%;width:50%;" id="favicon" src="@if(@isset($data)) {{asset($data->favicon)}} @else {{asset('Backend/Extra_image/no_image.jpg')}} @endif" />
                                                    </div>
                                                </div>                     

                                            </div>

                                          
                                            <div class="row"
                                                <div class="col m4 s12 submit">
                                                    <button id="aboutsubmit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> Update
                                                    </button>
                                                </div>
                                            </div>
                                  </div>
                              </div>
                            </form>

                        @endif




                    </div> 
                </div>
                <!-- settings Add End-->
              </div>
         




            <!-- settings show-->
              <!-- Responsive Table -->
          
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div style="background: #d2ef5e;color: black;text-align: center;"  class="card-header col m12 s12">
                            
                                 <h4 style="padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">Website Basic Settings Show
                                </h4>
                            
                         
                            </div>
                            <hr>
                          <div class="row">
                            <div class="col s12">
                            </div>
                            <div class="col s12">
                              <table class="responsive-table centered bordered">
                                <thead>
                                  <tr>
                                      <th data-field="sl">Sl</th>
                                      <th data-field="title">Website Name</th>
                                      <th data-field="image">Logo</th>
                                      <th data-field="published">Favicon</th>
                                      <th data-field="created_by">Created by</th>
                                      <th data-field="updated_by">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($settings)==0)
                                        <td colspan="7">No Data Found</td>
                                    @else
                                        @foreach($settings as $key)
                                            @php $prodID= Crypt::encrypt($key->id); @endphp
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td >
                                                {{$key->name}}
                                              </td>
                                            
                                              <td style="width:15%">
                                                <img style="max-width:100%" src="{{asset($key->logo)}}">
                                              </td>
                                              <td style="width:15%">
                                                  <img style="max-width:100%" src="{{asset($key->favicon)}}">
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
                                              <td>
                                                

                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('settings.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('settings.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
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
           
            <!-- settings show End-->
        </div>
    </div>
      <!-- END: Page Main-->

 <!-- Logo Live Show-->
<script type="text/javascript">

		// Logo Live Show
    function readURL(input){
        if(input.files.length==1){

            if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#logo')
                .attr('src',e.target.result)
                .width('50%');
                };
                reader.readAsDataURL(input.files[0]);
            }

        }else{
            var loadImage =  '<?php echo asset("Backend/Extra_image/no_image.jpg") ?>';
            $('#logo')
            .attr('src',loadImage)
            .width('50%');
                   
        }
        
    }

// Favicon Live Show

    function faviconImage(input){

        if(input.files.length==1){
            if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#favicon')
                .attr('src',e.target.result)
                .width('50%');
                
                };
                reader.readAsDataURL(input.files[0]);
            }

        }else{
            var loadImage =  '<?php echo asset("Backend/Extra_image/no_image.jpg") ?>';
            $('#favicon')
            .attr('src',loadImage)
            .width('50%');
                   
        }
        
    }

</script>

@endsection