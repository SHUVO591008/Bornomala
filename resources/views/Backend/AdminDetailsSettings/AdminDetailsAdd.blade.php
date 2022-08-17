@extends('layouts.BackendLayout')

@section('content')

<?php
use App\Model\AdminDetails;
use App\User;
$sl = 1;
$AdminDetails = AdminDetails::get();

$Admin = User::whereIn('role',['admin', 'super admin'])->where('status','active')->get();


?>

<style>
	.text-dark{
		    text-align: justify;
    	color: black;
    	font-size: 20px;
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
                        Admin Details Settings @if(@isset($data)) Edit @else Add @endif
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Admin Details Add/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

			@if($AdminDetails->isEmpty())
           
              <div class="col s12">
                <!-- AdminDetails settings Add -->
                <div class="container">
                    <div class="row">

                        <form id="AdminDetailssettings" class="col s12" action="{{route('admin.store')}}" method="POST" >
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                             <h4 style="float: left;" class="General card-title"> Admin Details</h4>
                                           

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
                                       
                                           <div class="input-field col m4 s12">
                                            
 											<select class="validate" name="user" id="user" data-error=".erroruser" required="">

	                                                <option value="" selected>Select Admin</option>

	                                                @foreach($Admin as $key)

	                                                	<option value="{{Crypt::encrypt($key->id)}}">{{$key->first_name}} {{$key->last_name}}</option>
	                                                @endforeach
	                                                
	                                               
                                              
                                                </select>
                                                <label>Admin: <span class="red-text">*</span></label>
                                                <small class="erroruser"></small>
                                              
                                              
                                            </div>

                                            <div class="input-field col m4 s12">
                                                <label for="name">Name <span class="red-text"></span></label>
                                                <input value="{{old('name')}}" id="name" name="name" type="text" data-error=".errorname">
                                                <small class="errorname"></small>
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
                                                  <textarea id="mytextarea" class="mytextarea validate" id="mytextarea" name="text" data-error=".errormytextarea" placeholder="Text here..." ></textarea>
                                                <small id="Valid" class="Valid"></small>
                                            </div>


                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="AdminDetailssubmit" class="waves-effect waves-dark btn btn-primary btnSubmit" type="submit">  Submit
                                                </button>
                                            </div>
                                        </div>
                              </div>
                          </div>
                        </form>


                    </div> 
                </div>
                <!-- AdminDetails settings Add End-->
              </div>
              @endif

              @if(@isset($data))
	              <div class="col s12">
	                <!-- AdminDetails settings Add -->
	                <div class="container">
	                    <div class="row">

	                        <form id="AdminDetailssettings" class="col s12" action="@if(@isset($data)){{route('admin.update',Crypt::encrypt($data->id))}} @else{{route('admin.store')}} @endif" method="POST" >
	                             @csrf
	                             <div class="card">
	                                    <div class="card-content">
	                                        <div  class="card-header col m12 s12">
	                                             <h4 style="float: left;" class="General card-title"> Admin Details</h4>
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
	                                       
	                                           <div class="input-field col m4 s12">
	                                            
	 											<select class="validate" name="user" id="user" data-error=".erroruser" required="">

		                                                <option value="" selected>Select Admin</option>

		                                                @foreach($Admin as $key)

		                                                	<option @if(@isset($data)) {{($data->user_id==$key->id)?'selected':''}} @else {{ old('user') == 'active' ? "selected" : "" }} @endif  value="{{Crypt::encrypt($key->id)}}">{{$key->first_name}} {{$key->last_name}}</option>
		                                                @endforeach
		                                                
		                                               
	                                              
	                                                </select>
	                                                <label>Admin: <span class="red-text">*</span></label>
	                                                <small class="erroruser"></small>
	                                              
	                                              
	                                            </div>

	                                            <div class="input-field col m4 s12">
	                                                <label for="name">Name <span class="red-text"></span></label>
	                                                <input value="@if(@isset($data)){{$data->name}}@else{{old('name')}}@endif" id="name" name="name" type="text" data-error=".errorname">
	                                                <small class="errorname"></small>
	                                            </div>



	                                            <div class="input-field col m4 s12">
	                                                <select class="validate" name="status" id="status" data-error=".errorStatus" required="">

	                                                <option value="" selected>Select Status</option>
	                                                <option @if(@isset($data)) {{($data->status==1)?'selected':''}} @else {{ old('status') == 'active' ? "selected" : "" }} @endif  value="active">Active</option>
	                                                
	                                                <option @if(@isset($data)) {{($data->status==0)?'selected':''}} @else {{ old('status') == 'inactive' ? "selected" : "" }} @endif  value="inactive">Inactive</option>
	                                              
	                                                </select>
	                                                <label>Status: <span class="red-text">*</span></label>
	                                                <small class="errorStatus"></small>
	                                            </div>

	                                           

	                                            <div class="input-field col m12 s12">
	                                                  <textarea id="mytextarea" class="mytextarea validate" id="mytextarea" name="text" data-error=".errormytextarea" placeholder="Text here..." >@if(@isset($data)){{$data->text}}@else{{old('text')}}@endif</textarea>
	                                                <small id="Valid" class="Valid"></small>
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
	                <!-- AdminDetails settings Add End-->
	              </div>
              @endif
         

       



            <!-- AdminDetails settings show-->
              <!-- Responsive Table -->
              @if($AdminDetails->isNotEmpty())
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">Admin Details Settings
                               
                                </h4>
                                 @foreach($AdminDetails as $key)
                                  @php $prodID= Crypt::encrypt($key->id); @endphp
                                  <div style="text-align:center;border-style: dashed;color: black;padding: 10px;font-weight: 700;font-size: 18px;" class=""><p>Show Or Hide</p>

                                       <div class="switch">
                                        <label>
                                          <span>Unpublished</span>
                                          <input data-column="{{route('admin.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
                                          <span class="lever"></span>
                                          <span>Published</span> 
                                        </label>
                                      </div>

                                </div>

                             
                               
                                <hr>
                            </div>
                          <div class="row">
                            <div class="col s12">
                            </div>
                            <div class="col s12">

                           
                           

                             <div class="card">
                             	<div class="row">
                             		<div class="col m2 mt-4">
										@if($key->user->image)
	          								<img class="rounded-circle img-responsive mx-auto" src="{{asset($key->user->image)}}" alt="">
	          							@else
	          								<img class="rounded-circle img-responsive mx-auto" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
	          							@endif

					                </div>

					                <div class="col m10">
                  						<div class="card-body">
                  							<h3 style="text-align:center;font-weight: 700;font-size: 23px;" class="card-title pt-2 pb-2">
												@if($key->name)
                  									{{$key->name}}
                  								@else
                  									{{$key->user->first_name}} {{$key->user->last_name}}
                  								@endif
                  							</h3>

                  							  

                    						<hr>

                    						 <p class="card-content text-dark">
                    						 	<?php echo $key->text?>
						                    </p>

                  						</div>
                  					</div>


                  					

                             	</div>
                             </div>

                             <a class="btn waves-effect waves-light amber darken-4 mr-5 mt-5" href="{{route('admin.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;margin-right: 12px;" class="fa-solid fa-pen-to-square"></i>
                             	Edit
                             </a>

                             <a class="delete-confirm btn waves-effect waves-light green darken-1 mt-5" href="{{ route('admin.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;margin-right: 12px;" class="fa-solid fa-trash-can"></i>Delete</a>


                             @endforeach

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               @endif
            <!-- AdminDetails settings show End-->
        </div>
    </div>
      <!-- END: Page Main-->


@endsection