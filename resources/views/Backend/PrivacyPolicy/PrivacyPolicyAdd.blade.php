@extends('layouts.BackendLayout')

@section('content')

<?php
use App\Model\privacypolicy;

$sl = 1;
$privacypolicy = privacypolicy::get();




?>

<style>
	.text-dark{
		    text-align: justify;
    	color: black;
    	font-size: 20px;
	}

	.tox-tinymce{

		height: 670px!important;

	}



.card-content{
    text-align: justify;
    font-size: 18px;
    color: black;
}

strong {
    font-weight: bold;
}



.pb-5 {
    padding-bottom: 3rem !important;
}

.fw-bold {
    font-weight: 700 !important;
}

.fs-5 {
    font-size: 1.25rem !important;
}
.pb-4 {
    padding-bottom: 1.5rem !important;
}

.ms-4 {
    margin-left: 1.5rem !important;
}

.pt-3 {
    padding-top: 1rem !important;
}

ul:not(.browser-default)>li {
        list-style-type: disc!important;
}
.policy li {
    list-style: inside;
    font-size: 17px;
    color: #000000b3;
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
                        Privacy Policy @if(@isset($data)) Edit @else Add @endif
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Privacy Policy
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

			@if($privacypolicy->isEmpty())
           
              <div class="col s12">
                <!-- privacypolicy settings Add -->
                <div class="container">
                    <div class="row">

                        <form id="privacypolicysettings" class="col s12" action="{{route('privacypolicy.store')}}" method="POST" >
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                             <h4 style="float: left;" class="General card-title"> Privacy Policy</h4>
                                           

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

                                            <div class="input-field col m12 s12">
                                                  <textarea id="mytextarea" class="mytextarea validate" id="mytextarea" name="text" data-error=".errormytextarea" placeholder="Text here..." ></textarea>
                                                <small id="Valid" class="Valid"></small>
                                            </div>


                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="privacypolicysubmit" class="waves-effect waves-dark btn btn-primary btnSubmit" type="submit">  Submit
                                                </button>
                                            </div>
                                        </div>
                              </div>
                          </div>
                        </form>


                    </div> 
                </div>
                <!-- privacypolicy settings Add End-->
              </div>
              @endif

              @if(@isset($data))
	              <div class="col s12">
	                <!-- privacypolicy settings Add -->
	                <div class="container">
	                    <div class="row">

	                        <form id="privacypolicysettings" class="col s12" action="@if(@isset($data)){{route('privacypolicy.update',Crypt::encrypt($data->id))}} @else{{route('privacypolicy.store')}} @endif" method="POST" >
	                             @csrf
	                             <div class="card">
	                                    <div class="card-content">
	                                        <div  class="card-header col m12 s12">
	                                             <h4 style="float: left;" class="General card-title"> Privacy Policy Details</h4>
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
	                                       

	                                            <div class="input-field col m12 s12">
	                                                  <textarea id="mytextarea" class="mytextarea validate" id="mytextarea" name="text" data-error=".errormytextarea" placeholder="Text here..." >@if(@isset($data)){{$data->text}}@else{{old('text')}}@endif</textarea>
	                                                <small id="Valid" class="Valid"></small>
	                                            </div>


	                                        </div>

	                                      
	                                        <div class="row"
	                                            <div class="col m4 s12 submit">
	                                                <button id="privacypolicysubmit" class="waves-effect waves-dark btn btn-primary btnSubmit" type="submit"> @if(@isset($data)) Update @else Submit @endif
	                                                </button>
	                                            </div>
	                                        </div>
	                              </div>
	                          </div>
	                        </form>


	                    </div> 
	                </div>
	                <!-- privacypolicy settings Add End-->
	              </div>
              @endif
         

       



            <!-- privacypolicy settings show-->
              <!-- Responsive Table -->
              @if($privacypolicy->isNotEmpty())
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">Privacy Policy Settings
                               
                                </h4>
                                 @foreach($privacypolicy as $key)
                                  @php $prodID= Crypt::encrypt($key->id); @endphp
 
                            </div>

                          <div class="row">
                          
                            <div class="col s12">
                             <div class="card">
          						<div class="card-body ">

          							<h5 style="text-align:center;" class="title text-center fw-bold pt-2 pb-1">
							             শর্তাবলি এবং প্রাইভেসি পলিসি
							           </h5>

							           <hr>
          						
            						 <div class="card-content text-dark">
            						 	<?php echo $key->text?>
				                    </div>

          						</div>
                             </div>

                             <a class="btn waves-effect waves-light amber darken-4 mr-5 mt-5" href="{{route('privacypolicy.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;margin-right: 12px;" class="fa-solid fa-pen-to-square"></i>
                             	Edit
                             </a>

                             <a class="delete-confirm btn waves-effect waves-light green darken-1 mt-5" href="{{ route('privacypolicy.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;margin-right: 12px;" class="fa-solid fa-trash-can"></i>Delete</a>


                             @endforeach

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               @endif
            <!-- privacypolicy settings show End-->
        </div>
    </div>
      <!-- END: Page Main-->


@endsection