@extends('layouts.BackendLayout')

@section('content')



<?php
use App\Model\slider;
$sl = 1;
$slider = slider::orderBy('id','desc')->get();

$Unpublished = $slider->where('status','0')->count();

$published = $slider->where('status','1')->count();

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
                        Slider Settings @if(@isset($data)) Edit @else Add @endif
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Slider settings Add/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

     
              <div class="col s12">
                <!-- slider settings Add -->
                <div class="container">
                    <div class="row">

                        <form id=@if(@isset($data))'Updateslidersettings'@else'slidersettings'@endif class="col s12" action="@if(@isset($data)){{route('slider.update',Crypt::encrypt($data->id))}} @else{{route('slider.store')}} @endif" method="POST"  enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">Slider Settings</h4>


                                             @if(@isset($data))
                                                <a class="btn right mr-3" href="{{route('slider.add')}}">Add</a>
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
                                             
                                           <div class="input-field col m12 s12">
                                                <label for="title">Title: <span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->text}}@else{{old('title')}}@endif" id="title" name="title" type="text" data-error=".errortitle">
                                                <small class="errortitle"></small>
                                            </div>

                                            <div class="input-field col m3 s12">

                                                <select class="validate select2 browser-default" name="style" id="style" data-error=".errorStyle" required="">

                                                <option value="" selected>Select Style</option>

                                                <option @if(@isset($data)) {{($data->style=='cube')?'selected':''}} @else {{ old('style') == 'cube' ? "selected" : "" }} @endif  value="cube">cube</option>

                                                <option @if(@isset($data)) {{($data->style=='cubeRandom')?'selected':''}} @else {{ old('style') == 'cubeRandom' ? "selected" : "" }} @endif  value="cubeRandom">cubeRandom</option>

                                                <option @if(@isset($data)) {{($data->style=='block')?'selected':''}} @else {{ old('style') == 'block' ? "selected" : "" }} @endif  value="block">block</option>

                                                <option @if(@isset($data)) {{($data->style=='cubeStop')?'selected':''}} @else {{ old('style') == 'cubeStop' ? "selected" : "" }} @endif  value="cubeStop">cubeStop</option>

                                                <option @if(@isset($data)) {{($data->style=='cubeStopRandom')?'selected':''}} @else {{ old('style') == 'cubeStopRandom' ? "selected" : "" }} @endif  value="cubeStopRandom">cubeStopRandom</option>

                                                <option @if(@isset($data)) {{($data->style=='cubeHide')?'selected':''}} @else {{ old('style') == 'cubeHide' ? "selected" : "" }} @endif  value="cubeHide">cubeHide</option>

                                                <option @if(@isset($data)) {{($data->style=='cubeSize')?'selected':''}} @else {{ old('style') == 'cubeSize' ? "selected" : "" }} @endif  value="cubeSize">cubeSize</option>

                                                <option @if(@isset($data)) {{($data->style=='horizontal')?'selected':''}} @else {{ old('style') == 'horizontal' ? "selected" : "" }} @endif  value="horizontal">horizontal</option>

                                                <option @if(@isset($data)) {{($data->style=='showBars')?'selected':''}} @else {{ old('style') == 'showBars' ? "selected" : "" }} @endif  value="showBars">showBars</option>

                                                <option @if(@isset($data)) {{($data->style=='showBarsRandom')?'selected':''}} @else {{ old('style') == 'showBarsRandom' ? "selected" : "" }} @endif  value="showBarsRandom">showBarsRandom</option>

                                                <option @if(@isset($data)) {{($data->style=='tube')?'selected':''}} @else {{ old('style') == 'tube' ? "selected" : "" }} @endif  value="tube">tube</option>

                                                <option @if(@isset($data)) {{($data->style=='fade')?'selected':''}} @else {{ old('style') == 'fade' ? "selected" : "" }} @endif  value="fade">fade</option>

                                                <option @if(@isset($data)) {{($data->style=='fadeFour')?'selected':''}} @else {{ old('style') == 'fadeFour' ? "selected" : "" }} @endif  value="fadeFour">fadeFour</option>

                                                <option @if(@isset($data)) {{($data->style=='paralell')?'selected':''}} @else {{ old('style') == 'paralell' ? "selected" : "" }} @endif  value="paralell">paralell</option>

                                                <option @if(@isset($data)) {{($data->style=='blind')?'selected':''}} @else {{ old('style') == 'blind' ? "selected" : "" }} @endif  value="blind">blind</option>

                                                <option @if(@isset($data)) {{($data->style=='blindHeight')?'selected':''}} @else {{ old('style') == 'blindHeight' ? "selected" : "" }} @endif  value="blindHeight">blindHeight</option>

                                                <option @if(@isset($data)) {{($data->style=='blindWidth')?'selected':''}} @else {{ old('style') == 'blindWidth' ? "selected" : "" }} @endif  value="blindWidth">blindWidth</option>

                                                <option @if(@isset($data)) {{($data->style=='directionTop')?'selected':''}} @else {{ old('style') == 'directionTop' ? "selected" : "" }} @endif  value="directionTop">directionTop</option>

                                                <option @if(@isset($data)) {{($data->style=='directionBottom')?'selected':''}} @else {{ old('style') == 'directionBottom' ? "selected" : "" }} @endif  value="directionBottom">directionBottom</option>

                                                <option @if(@isset($data)) {{($data->style=='directionRight')?'selected':''}} @else {{ old('style') == 'directionRight' ? "selected" : "" }} @endif  value="directionRight">directionRight</option>


                                                <option @if(@isset($data)) {{($data->style=='directionLeft')?'selected':''}} @else {{ old('style') == 'directionLeft' ? "selected" : "" }} @endif  value="directionLeft">directionLeft</option>

                                                <option @if(@isset($data)) {{($data->style=='cubeSpread')?'selected':''}} @else {{ old('style') == 'cubeSpread' ? "selected" : "" }} @endif  value="cubeSpread">cubeSpread</option>

                                                <option @if(@isset($data)) {{($data->style=='glassCube')?'selected':''}} @else {{ old('style') == 'glassCube' ? "selected" : "" }} @endif  value="glassCube">glassCube</option>

                                                <option @if(@isset($data)) {{($data->style=='glassBlock')?'selected':''}} @else {{ old('style') == 'glassBlock' ? "selected" : "" }} @endif  value="glassBlock">glassBlock</option>

                                                <option @if(@isset($data)) {{($data->style=='circles')?'selected':''}} @else {{ old('style') == 'circles' ? "selected" : "" }} @endif  value="circles">circles</option>

                                                <option @if(@isset($data)) {{($data->style=='circlesInside')?'selected':''}} @else {{ old('style') == 'circlesInside' ? "selected" : "" }} @endif  value="circlesInside">circlesInside</option>

                                                
                                                <option @if(@isset($data)) {{($data->style=='circlesRotate')?'selected':''}} @else {{ old('style') == 'circlesRotate' ? "selected" : "" }} @endif  value="circlesRotate">circlesRotate</option>

                                                <option @if(@isset($data)) {{($data->style=='cubeShow')?'selected':''}} @else {{ old('style') == 'cubeShow' ? "selected" : "" }} @endif  value="cubeShow">cubeShow</option>

                                                <option @if(@isset($data)) {{($data->style=='upBars')?'selected':''}} @else {{ old('style') == 'upBars' ? "selected" : "" }} @endif  value="upBars">upBars</option>

                                                <option @if(@isset($data)) {{($data->style=='downBars')?'selected':''}} @else {{ old('style') == 'downBars' ? "selected" : "" }} @endif  value="downBars">downBars</option>

                                                <option @if(@isset($data)) {{($data->style=='hideBars')?'selected':''}} @else {{ old('style') == 'hideBars' ? "selected" : "" }} @endif  value="hideBars">hideBars</option>

                                                <option @if(@isset($data)) {{($data->style=='swapBars')?'selected':''}} @else {{ old('style') == 'swapBars' ? "selected" : "" }} @endif  value="swapBars">swapBars</option>

                                                <option @if(@isset($data)) {{($data->style=='swapBarsBack')?'selected':''}} @else {{ old('style') == 'swapBarsBack' ? "selected" : "" }} @endif  value="swapBarsBack">swapBarsBack</option>

                                                <option @if(@isset($data)) {{($data->style=='swapBlocks')?'selected':''}} @else {{ old('style') == 'swapBlocks' ? "selected" : "" }} @endif  value="swapBlocks">swapBlocks</option>

                                                <option @if(@isset($data)) {{($data->style=='cut')?'selected':''}} @else {{ old('style') == 'cut' ? "selected" : "" }} @endif  value="cut">cut</option>
                                                </select>
                                                <small class="errorStyle"></small>
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

                                            <div class="input-field col m12 s12">
                                                <div style="text-align: center;" class="">
                                                    <img style="max-width: 50%;width:50%;height: 292px" id="image" src="@if(@isset($data)) {{asset($data->image)}} @else {{asset('Backend/Extra_image/no_image.jpg')}} @endif" />
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
                <!-- slider settings Add End-->
              </div>
         




            <!-- slider settings show-->
              <!-- Responsive Table -->
          
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div style="background: #d2ef5e;color: black;"  class="card-header col m12 s12">
                            <div class="col m4 s12 l4">
                                 <h4 style="padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">Slider Settings Show
                                </h4>
                            </div>
                               
                            <div class="col m4 s12 l4">
                                 <h4 style="font-size: 20px;font-weight: 700;text-align: center;">Unpublished : <span id="unpublished">{{$Unpublished}}</span></h4>
                            </div>

                              <div class="col m4 s12 l4">
                                <h4 style="font-size: 20px;font-weight: 700;text-align: right;">Published : <span id="published">{{$published}}</span></h4>
                            </div>
                                
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
                                      <th data-field="title">Title</th>
                                      <th data-field="style">Style</th>
                                      <th data-field="image">Image</th>
                                      <th data-field="published">Status</th>
                                      <th data-field="created_by">Created by</th>
                                      <th data-field="updated_by">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($slider)==0)
                                        <td colspan="7">No Data Found</td>
                                    @else
                                        @foreach($slider as $key)
                                            @php $prodID= Crypt::encrypt($key->id); @endphp
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td style="width:20%">
                                                @if($key->text==NULL)
                                                    N/A
                                                @else
                                                    {{$key->text}}
                                                @endif
                                              </td>
                                              <td>
                                                  {{$key->style}}
                                              </td>
                                              <td style="width:20%">
                                                <img style="max-width:100%" src="{{asset($key->image)}}">
                                                
                                              </td>
                                              <td style="width:15%">
                                                  <div class="switch">
                                                    <label>
                                                      <span>Unpublished</span>
                                                      <input data-column="{{route('slider.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
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
                                                 <a target="_blank" class="btn-floating waves-effect waves-light amber darken-3 mr-5" href="{{route('slider.view',$prodID)}}" title="View"><i style="font-size: 14px;" class="fa-solid fa-eye"></i></a>

                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('slider.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('slider.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
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
           
            <!-- Slider settings show End-->
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
                .width(773)
                .height(292);
                };
                reader.readAsDataURL(input.files[0]);
            }

        }else{
            var loadImage =  '<?php echo asset("Backend/Extra_image/no_image.jpg") ?>';
            $('#image')
            .attr('src',loadImage)
            .width(773)
            .height(292);
                   
        }

      

        
    }
</script>

@endsection