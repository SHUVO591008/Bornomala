@extends('layouts.BackendLayout')

@section('content')

<?php
use App\Model\ContactDetails;
use App\Model\socialContact;

$sl = 1;
$ContactDetails = ContactDetails::get();
$socialContact = socialContact::get();



?>

<style>
	.text-dark{
		    text-align: justify;
    	color: black;
    	font-size: 20px;
	}



    .social-p  {
        width: 100%;
        display: block;
        border-bottom: 1px solid yellow;
        padding-bottom: 10px;
        font-weight: 600;
    }

    h5.pl-3.title-contact {
        font-weight: 600;
        font-size: 29px;
        border-bottom: 2px solid black;
        padding-bottom: 17px;
    }
    .contact-p p{
        FONT-SIZE: 22px;
        text-align: justify;
        color: black;
        padding: 32px;
    }



    .social-group-title {

        border-bottom: 2px solid #5bd70e;
        display: block;
        font-weight: 600!important;
        border-bottom-style: dashed;
        padding-bottom: 10px;
    }

    .switch-div span {
        font-size: 16px;
        font-weight: 600;
        color: black;
    }
</style>



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
                        Contact Page Settings @if(@isset($data)) Edit @else Add @endif
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Contact page Settings Add/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

			@if($ContactDetails->isEmpty())
           
              <div class="col s12">
                <!-- ContactDetails settings Add -->
                <div class="container">
                    <div class="row">

                        <form id="ContactDetailssettings" class="col s12" action="{{route('contactDetails.store')}}" method="POST" >
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                             <h4 style="float: left;" class="General card-title"> Contact page Details</h4>
                                           

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
                                       

                                            <div class="input-field col m8 s12">
                                                <label for="title">Title <span class="red-text"></span></label>
                                                <input value="{{old('title')}}" id="title" name="title" type="text" data-error=".errortitle">
                                                <small class="errortitle"></small>
                                            </div>



                                            <div class="input-field col m4 s12">
                                                <select class="validate" name="status" id="status" data-error=".errorStatus" required="">

                                                <option value="" selected>Select Status</option>
                                                <option value="active">Active</option>
                                                
                                                <option value="inactive">Inactive</option>
                                              
                                                </select>
                                                <label>Status: <span class="red-text">*</span></label>
                                                <small class="errorStatus"></small>
                                            </div>

                                           

                                            <div class="input-field col m12 s12">
                                                  <textarea id="mytextarea" class="mytextarea validate" name="mytextarea" data-error=".errormytextarea" placeholder="Text here..." ></textarea>
                                                <small id="Valid" class="Valid"></small>
                                            </div>


                                              <div class="input-field col m12 s12">
                                                <label for="map">Map iframe<span class="red-text"></span></label>
                                                <input value="{{old('map')}}" id="map" name="map" type="text" data-error=".errormap">
                                                <small class="errormap"></small>
                                            </div>


                                           <div  class="card-header col m12 s12">
                                             <h4  class="social-group-title General card-title mb-2"> Social Contact Group</h4>

                                              <div  class="addRow" id="addRow">
                                                <div id="delete_add_more_item" class="delete_add_more_item">
                                                        <div class="row">

                                                            <div class="input-field col m2 s6">
                                                                <div id="add" class="btn-light btn add"><i class="fas fa-plus-circle"></i><span class=""> ADD</span></div>

                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                           

                                            </div>
                                        </div>

                                      
                                    <div class="row"
                                        <div class="col m4 s12 submit">
                                            <button id="contactDetailssubmit" class="waves-effect waves-dark btn btn-primary btnSubmit mt-5" type="submit">  Submit
                                            </button>
                                        </div>
                                    </div>
                              </div>
                          </div>
                        </form>
                    </div> 
                </div>
                <!-- ContactDetails settings Add End-->
              </div>
            @endif

              @if(@isset($data))
	              <div class="col s12">
	                <!-- ContactDetails settings Add -->
	                <div class="container">
	                    <div class="row">

	                        <form id="ContactDetailssettings" class="col s12" action="{{route('contactDetails.update')}}" method="POST" >
	                             @csrf
	                             <div class="card">
	                                    <div class="card-content">
	                                        <div  class="card-header col m12 s12">
	                                             <h4 style="float: left;" class="General card-title"> Contact page Details</h4>
	                                             @if(@isset($data))
	                                                <a class="btn right mr-3" href="{{url()->previous()}}"><i style="font-size:15px!important;margin-right: 11px!important;" class="fa-solid fa-arrow-left mr-2"></i>Back</a>
	                                            @endif

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
                                       

                                            <div class="input-field col m8 s12">
                                                <label for="title">Title <span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->title}}@else{{old('title')}}@endif" id="title" name="title" type="text" data-error=".errortitle">
                                                <small class="errortitle"></small>
                                            </div>



                                            <div class="input-field col m4 s12">
                                                <select class="validate" name="status" id="status" data-error=".errorStatus" required="">

                                                <option value="" selected>Select Status</option>
                                                <option @if(@isset($data)) {{($data->status==1)?'selected':''}} @else {{ old('status') == 'active' ? "selected" : "" }} @endif value="active">Active</option>
                                                
                                                <option @if(@isset($data)) {{($data->status==0)?'selected':''}} @else {{ old('status') == 'inactive' ? "selected" : "" }} @endif  value="inactive">Inactive</option>
                                              
                                                </select>
                                                <label>Status: <span class="red-text">*</span></label>
                                                <small class="errorStatus"></small>
                                            </div>

                                           

                                            <div class="input-field col m12 s12">
                                                  <textarea id="mytextarea" class="mytextarea validate" name="mytextarea" data-error=".errormytextarea" placeholder="Text here..." >@if(@isset($data)){{$data->text}}@else{{old('mytextarea')}}@endif</textarea>
                                                <small id="Valid" class="Valid"></small>
                                            </div>


                                            <div class="input-field col m12 s12">
                                                <label for="map">Map iframe<span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->map}}@else{{old('map')}}@endif" id="map" name="map" type="text" data-error=".errormap">
                                                <small class="errormap"></small>
                                            </div>


                                           <div  class="card-header col m12 s12">
                                             <h4  class="social-group-title General card-title mb-2"> Social Contact Group</h4>

                                              <div  class="addRow" id="addRow">
                                                <div id="delete_add_more_item" class="delete_add_more_item">
                                                        <div class="row">

                                                            <div class="input-field col m12 s12">
                                                                <div id="add" class="btn-light btn add">
                                                                    <i class="fas fa-plus-circle"></i><span class=""> ADD</span>
                                                                </div>
                                                            </div>

                                                        @foreach($data1 as $key)

                                                        <?php $sl++?>
                                                            <div class="delete_add_more_item " id="delete_add_more_item">
                                                           

                                                                    <div class="input-field col m3 s6">
                                                                        <label>Name</label>
                                                                        <input id="name{{$sl}}" name="name[]" class="validate" type="text" data-error=".nameerror{{$sl}}" value="{{$key->name}}" >
                                                                         <small class="nameerror{{$sl}}"></small>
                                                                    </div>

                                                                    <div class="input-field col m5 s6">
                                                                        <label>Url</label>
                                                                        <input id="url{{$sl}}" class="validate" type="url" name="socialUrl[]" data-error=".urlerror{{$sl}}" value="{{$key->url}}">
                                                                         <small class="urlerror{{$sl}}"></small>
                                                                    </div>

                                                                    <div class="input-field col m2 s6">
                                                                                                               
                                                                         <select class="validate" name="statussocial[]" id="socialstatusID{{$sl}}" data-error=".socialerrorStatus{{$sl}}" required="">

                                                                          

                                                                            <option value="" selected>Select Status</option>
                                                                            <option {{($key->status==1)?'selected':''}}  value="active">Active</option>
                                                                            
                                                                            <option {{($key->status==0)?'selected':''}} value="inactive">Inactive</option>
                                                                          
                                                                        </select>
                                                                        <label>Status: <span class="red-text">*</span></label>
                                                                        <small class="socialerrorStatus{{$sl}}"></small>
                                                                    </div>

                                                                    <div class="input-field col m2 s6">
                                                                        <div id="add" class="btn-light btn add"><i class="fas fa-plus-circle"></i></div>

                                                                        <div class="red btn removeeventmore"><i class="fas fa-minus-circle"></i></div>
                                                                    </div>

                                                               
                                                            </div>
                                                        @endforeach

                                                    
                                                        
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>

	                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="AdminDetailssubmit" class="waves-effect waves-dark btn btn-primary btnSubmit" type="submit"> @if(@isset($data)) Update @else Submit @endif
                                                </button>
                                            </div>
                                        </div>
	                              </div>
	                          </div>
	                        </form>


	                    </div> 
	                </div>
	                <!-- ContactDetails settings Add End-->
	              </div>
              @endif
         

    

            <!-- ContactDetails settings show-->
            @if(!@isset($data))
              @if($ContactDetails->isNotEmpty())
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">Contact Details Settings
                               
                                </h4>
                                 @foreach($ContactDetails as $key)
                                  @php $prodID= Crypt::encrypt($key->id); @endphp
                                  <div style="text-align:center;border-style: dashed;color: black;padding: 10px;font-weight: 700;font-size: 18px;" class=""><p>Show Or Hide</p>

                                       <div class="switch">
                                        <label>
                                          <span>Unpublished</span>
                                          <input data-column="{{route('contactDetails.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
                                          <span class="lever"></span>
                                          <span>Published</span> 
                                        </label>
                                      </div>

                                </div>

                             
                               
                                <hr>
                            </div>
                          <div class="row">
                           
                            <div class="col s12">

                           
                           

                             <div class="card">
                             	<div class="row">
                                    <div class="col s12">
                                        <h4 style="text-align:center;font-weight: 600;" class="pt-2 pb-1">যোগাযোগ</h4>
                                    <hr>
                                    </div>

                                    <div class="col s6 pt-3">

                                        <h5 class="pl-3 title-contact">{{$key->title}}</h5>

                                        <div class="pb-3 pl-3 contact-p">
                                            
                                            <?php echo $key->text?>
                                        </div>


                                    @if($socialContact->isNotEmpty())
                                         <p class="fw-bold text-dark pl-3">

                                            <span class="social-p mb-3">সোশ্যাল মিডিয়ায় আমাদের গ্রুপ -</span> 
                                         </p>
                                        @foreach($socialContact as $val)
                                         @php $ID= Crypt::encrypt($val->id); @endphp
                                        <div style="text-align:center" class="col s6 mt-4 mb-4">

                                            <a class="btn-large" href="{{$val->url}}" target="_blank">{{$val->name}}</a>

                                            <div class="switch pt-5 switch-div">
                                                <label>
                                                  <span>Unpublished</span>
                                                  <input data-column="{{route('socialContact.status')}}" class="status" data-id="{{$ID}}" id="status" {{($val->status==1)?'checked':''}} type="checkbox">
                                                  <span class="lever"></span>
                                                  <span>Published</span> 
                                                </label>
                                              </div>   
                                        </div>
                                        @endforeach
                                    @endif

                                    </div>
                                    
                                     <div class="col s6 pt-3">
                                         <?php echo $key->map ?> 

                                    </div>

                                    


                             	</div>
                             </div>

                             <a class="btn waves-effect waves-light amber darken-4 mr-5 mt-5" href="{{route('contactDetails.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;margin-right: 12px;" class="fa-solid fa-pen-to-square"></i>
                             	Edit
                             </a>

                             <a class="delete-confirm btn waves-effect waves-light green darken-1 mt-5" href="{{ route('contactDetails.delete') }}" title="Delete"><i style="font-size: 14px;margin-right: 12px;" class="fa-solid fa-trash-can"></i>Delete</a>


                             @endforeach

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               @endif
            @endif
            <!-- ContactDetails settings show End-->
        </div>
    </div>
      <!-- END: Page Main-->


<!-- x-handlebars-template social Information-->
<script id="document-template" type="text/x-handlebars-template">

        <div class="delete_add_more_item " id="delete_add_more_item">
           <div id="socialiconselect2" class="row">

                 <div class="input-field col m3 s6">
                    <label>Name</label>
                    <input id="name" name="name[]" class="validate" type="text" data-error=".nameerror">
                     <small class="nameerror"></small>
                </div>

                <div class="input-field col m5 s6">
                    <label>Url</label>
                    <input id="url" class="validate" type="url" name="socialUrl[]" data-error=".urlerror" >
                     <small class="urlerror"></small>
                </div>

                 <div class="input-field col m2 s6">
                                                           
                     <select class="validate" name="statussocial[]" id="socialstatus2" data-error=".socialerrorStatus" required="">

                      

                        <option value="" selected>Select Status</option>
                        <option value="active">Active</option>
                        
                        <option value="inactive">Inactive</option>
                      
                    </select>
                        <label>Status: <span class="red-text">*</span></label>
                        <small class="socialerrorStatus"></small>
                </div>

                <div class="input-field col m2 s6">
                    <div id="add" class="btn-light btn add"><i class="fas fa-plus-circle"></i></div>

                    <div class="red btn removeeventmore"><i class="fas fa-minus-circle"></i></div>
                </div>

            </div>

        </div>
 </script>
 <!-- x-handlebars-template social Information End-->

@endsection