@extends('layouts.BackendLayout')

@section('content')

<style>


.msg{
    text-align: center;
    border-style: dashed;
    color: black;
    padding: 10px;
    font-weight: 700;
    font-size: 27px;
}


.title-table {
    font-size: 23px;
    font-weight: 600;
    color: black;
    text-transform: uppercase;
    font-family: sans-serif;
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
                        	Message
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Message View
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

              <div class="col s12 ">
                
                <!-- message  -->
                <div class="container">
                    <div class="row">
                    
	                    <div  class="card-header col m12 s12 mt-3">
                             <a class="btn right " href="{{url()->previous()}}"><i style="font-size:15px!important;margin-right: 11px!important;" class="fa-solid fa-arrow-left mr-2"></i>Back </a>

               
	                    </div>


                        <div class="col m12 s12">

                          

                            <div class="card">
                                <div class="card-content">
                                      <h4 class="fs-md-1 msg">Message</h4>

                                      <table class="centered bordered">
                                        <td class="title-table" colspan="8">Information</td>
                                          <tr>
                                                <th>Name : {{$data->name}}</th>
                                                <th>Email : {{$data->email}}</th>
                                                <th>Mobile : {{$data->mobile}}</th>
                                                <th>IP : {{$data->ip}}</th>
                                                <th>Country : {{$data->country}}</th>
                                                <th>City : {{$data->city}}</th>
                                                <th>Device : {{$data->device}}</th>
                                                <th>Time : {{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</th>

                                                
                                          </tr>
                                         
                                      </table>

                                      <table class="centered bordered">
                                          <tr>
                                            <th>Message:-</th>
                                            <th colspan="7">
                                                  {{$data->text}}
                                            </th>
                                         </tr>

                                      </table>

                                <p>
                                                                      

                            </div>
                        </div>
                      
           				</div>

           			

                    </div> 
                </div>
                <!-- message  End-->
              </div>

          
              
        </div>
    </div>
      <!-- END: Page Main-->
@endsection