<?php

$sl = 1;

?>

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
                        Questions And Answer View
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Questions And Answer View
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>
    	<div class="container">
            <div class="row">

		      <div class="row">
		           <div class="col s12">
		              <h5 class="pt-2 pb-2" style="text-align:center ;font-weight: 600";>*** আমাদের সম্পর্কে জিজ্ঞাসিত প্রশ্নাবলি ***</h3>
		              	
		              <hr>
		           </div>
		           <div class="col s12">
		           	<a class="btn mb-2 btn waves-effect waves-light amber darken-4" href="{{url()->previous()}}"><i style="font-size:15px!important;margin-right: 11px!important;" class="fa-solid fa-arrow-left mr-2"></i>Back </a>

		              <ul class="collapsible collapsible-accordion">

		              	@foreach($data as $key)
			                 <li class="{{ ($decryptedID==$key->id)?'active':'' }}">
			                    <div class="collapsible-header light-blue light-blue-text text-lighten-5">
			                       {{ $sl++ }}. প্রশ্নঃ- {{$key->qus}} --- ( {{($key->status==1)?"Published":"Unpublished"}} )
			                     
			                    </div>
			                    <div class="collapsible-body light-blue lighten-5">
			                       <p>
			                          
									<?php echo $key->ans?>
			                       </p>
			                    </div>
			                 </li>
						@endforeach
		            

		              </ul>
		           </div>
		       </div>
   			</div>
		</div>
  </div>
</div>

@endsection