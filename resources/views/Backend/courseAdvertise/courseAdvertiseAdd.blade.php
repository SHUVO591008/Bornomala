@extends('layouts.BackendLayout')

@section('content')
<?php
use App\Model\courseAdvertise;

$sl = 1;
$courseAdvertise = courseAdvertise::all();


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
                       Course Advertisement Settings @if(@isset($data)) Edit @else Add @endif
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
                
                <!-- Course Advertisement settings Add -->
                <div class="container">
                    <div class="row">
                        <form id=@if(@isset($data))'UpdatecourseAdvertisment'@else'courseAdvertismentsettings'@endif  class="col s12" action="@if(@isset($data)){{route('courseAdvertise.update',Crypt::encrypt($data->id))}} @else{{route('courseAdvertise.store')}} @endif" method="POST" enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">Course Advertisement Settings</h4>

                                            @if(@isset($data))
                                                 <a class="btn right mr-3" href="{{route('courseAdvertise.add')}}">Add</a>
                                             @endif
                                           

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
                                             <div class="input-field col m9 s12">
                                                <label for="title">Title: <span class="red-text">*</span></label>
                                                <input value="@if(@isset($data)){{$data->title}}@else{{old('title')}}@endif" id="title" name="title" type="text" class="validate" data-error=".errortitle" required="">
                                                <small class="errortitle"></small>
                                            </div>



                                            <div class="input-field col m3 s12">
                                                <select class="validate" name="position" id="position" data-error=".errorposition" required="">

                                                <option value="" selected>Select Position</option>
                                                <option @if(@isset($data)) {{($data->position=='left')?'selected':''}} @else {{ old('position') == 'left' ? "selected" : "" }} @endif  value="left">Left</option>
                                                
                                                <option @if(@isset($data)) {{($data->position=='right')?'selected':''}} @else {{ old('position') == 'right' ? "selected" : "" }} @endif  value="right">Right</option>
                                              
                                                </select>
                                                <label>Position: <span class="red-text">*</span></label>
                                                <small class="errorposition"></small>
                                            </div>



                                            <div class="input-field col m12 s12">
                                                <label for="text">Details: <span class="red-text">*</span></label>
                                                <input value="@if(@isset($data)){{$data->des}}@else{{old('text')}}@endif" id="text" name="text" type="text" class="validate" data-error=".errortext" required="">
                                                <small class="errortext"></small>
                                            </div>

                                            <div class="input-field col m3 s12">
                                                <select class="validate" name="btn" id="btn" data-error=".errorbtn" required="">

                                                <option value="" selected>Select On/Off</option>
                                                <option @if(@isset($data)) {{($data->btn=='on')?'selected':''}} @else {{ old('btn') == 'on' ? "selected" : "" }} @endif  value="on">On</option>
                                                
                                                <option @if(@isset($data)) {{($data->btn=='off')?'selected':''}} @else {{ old('btn') == 'off' ? "selected" : "" }} @endif  value="off">Off</option>
                                              
                                                </select>
                                                <label>Button On/Off: <span class="red-text">*</span></label>
                                                <small class="errorbtn"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="btn_url">Button Link: <span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->btn_url}}@else{{old('btn_url')}}@endif" id="btn_url" name="btn_url" type="url" class="validate" data-error=".errorbtn_url">
                                                <small class="errorbtn_url"></small>
                                            </div>

                                            

                                            <div class="input-field col m3 s12">
                                                <select class="validate" name="status" id="status" data-error=".errorStatus" required="">

                                                <option value="" selected>Select Status</option>
                                                <option @if(@isset($data)) {{($data->status==1)?'selected':''}} @else {{ old('status') == 'active' ? "selected" : "" }} @endif  value="active">Active</option>
                                                
                                                <option @if(@isset($data)) {{($data->status==0)?'selected':''}} @else {{ old('status') == 'inactive' ? "selected" : "" }} @endif  value="inactive">Inactive</option>
                                              
                                                </select>
                                                <label>Status: <span class="red-text">*</span></label>
                                                <small class="errorStatus"></small>
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

                                            <div class="input-field col m3 s12">
                                                <div class="float-right">
                                                    <img style="max-width: 100%;width:100%" id="image" src="@if(@isset($data)) {{asset($data->image)}} @else {{asset('Backend/Extra_image/no_image.jpg')}} @endif" />
                                                </div>
                                            </div> 

                                        
                                
                                             

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
                <!-- institute settings Add End-->
              </div>

            <!-- institute settings show-->
              <!-- Responsive Table -->
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Course Advertisement</h4>
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
                                      <th data-field="position">Position</th>
                                      <th data-field="btn_link">Button Link</th>
                                      <th data-field="btn_on_off">Button On/Off</th>
                                      <th data-field="image">Image</th>
                                      <th data-field="status">Status</th>
                                      <th data-field="created_by">Created by</th>
                                      <th data-field="updated_by">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($courseAdvertise)==0)
                                        <td colspan="11">No Data Found</td>
                                    @else
                                        @foreach($courseAdvertise as $key)
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td>{{$key->title}}</td>
                                              <td style="width:20%">
                                                @if($key->des==NULL)
                                                    N/A
                                                @else
                                                    {{$key->des}}
                                                @endif
                                              </td>
                                              <td style="text-transform:capitalize;">
                                                {{$key->position}}
                                              </td>

                                              <td>
                                                @if($key->btn_url==NULL)
                                                    N/A
                                                @else
                                                    {{$key->btn_url}}
                                                @endif
                                              </td>

                                               <td style="width:10%">
                                                 @php $prodID= Crypt::encrypt($key->id); @endphp

                                                <div class="switch">
                                                    <label>
                                                      <span>OFF</span>
                                                      <input data-column="{{route('courseAdvertise.btn')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->btn=="on")?'checked':''}} type="checkbox">
                                                      <span class="lever"></span>
                                                      <span>ON</span> 
                                                    </label>
                                                </div>
                                              </td>

                                               <td style="width:8%">
                                                <img style="max-width:100%" src="{{asset($key->image)}}">
                                                
                                              </td>


                                              <td style="width:15%">
                                                 @php $prodID= Crypt::encrypt($key->id); @endphp

                                                <div class="switch">
                                                    <label>
                                                      <span>Inactive</span>
                                                      <input data-column="{{route('courseAdvertise.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
                                                      <span class="lever"></span>
                                                      <span>Active</span> 
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
                                              <td style="width:10%">
                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('courseAdvertise.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('courseAdvertise.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
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
            <!-- institute settings show End-->
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
                .width(363)
                .height(363);
                };
                reader.readAsDataURL(input.files[0]);
            }

        }else{
            var loadImage =  '<?php echo asset("Backend/Extra_image/no_image.jpg") ?>';
            $('#image')
            .attr('src',loadImage)
            .width(363)
            .height(363);
                   
        }

      

        
    }
</script>
@endsection