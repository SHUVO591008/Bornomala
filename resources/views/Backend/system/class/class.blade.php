@extends('layouts.BackendLayout')

@section('content')
<?php

$sl = 1;


?>


<style>

.users-list-table .dataTables_length label select {
    display: inline-block;
    width: auto;
    height: auto;
}

.users-list-table .dataTables_filter label input {
    width: auto;
    height: auto;
    margin-left: 0.5rem;
}


.modal-title {
    background: #110c48;
    overflow: auto;
    padding: 10px 29px;
    border-radius: 11px;
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
                        Class List
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

   
            <!-- Class settings show-->
              <div class="users-list-table">
                  <div class="card">
                    <div class="card-content">
                        <div  class="card-header col m12 s12">
                            <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Class Table
                                <a id="classAdd" class="mb-6 btn waves-effect waves-light darken-1 modal-trigger" style="float: right;background-color: black;" href="#modal2"><i class="fas fa-plus-circle"></i> Add New</a>
                            </h4>

                            <hr>

                           
                        </div>



                      <!-- Page Length Options -->
                        <div class="row">
                        <div class="col s12">
                        <div class="card">
                        <div class="card-content">
                          <h4 class="card-title">Class Table Show</h4>
                          <div class="row">
                            <div class="col s12">
                              <table id="page-length-option" class="display bordered centered">
                                <thead>
                                  <tr>
                                      <th>SL</th>
                                      <th>Name </th>
                                      <th>Admission Fee</th>
                                      <th>Monthly Fee</th>
                                      <th>Exam Fee</th>
                                      <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($class as $key)
                                    @php 
                                    $prodID= Crypt::encrypt($key->id);
                                    $check = DB::table('sections')->where('class_id',$key->id)->first();
                                     @endphp
                                        <tr>
                                          <td>{{ $sl++ }}</td>
                                          <td>{{ $key->class }}</td>
                                          <td>{{ $key->admission_fees }}</td>
                                          <td>{{ $key->monthly_fee }}</td>
                                          <td>{{ $key->exam_fee }}</td>


                                          <td>
                                            
                                            <a id="editClass" data-id="{{$prodID}}" class="btn-floating waves-effect waves-light amber darken-4 mr-5 modal-trigger editClass" href="#modal3" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a> 

                                            @if(is_null($check))
                                                <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('class.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>

                                             @else
                                                <a onclick="alert('Sorry..! Could not be deleted now.')" class=" btn-floating waves-effect waves-light blue darken-1" href="javascript:void(0)" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>

                                            @endif

                                          </td>
                                        </tr>
                                      @endforeach
                    
                                </tbody>
                               
                              </table>
                            </div>
                          </div>
                        </div>
                        </div>
                        </div>
                        </div>


                    </div>
                  </div>
                </div>
            <!-- Class settings show End-->


        </div>
    </div>
      <!-- END: Page Main-->

    {{-- modal start here --}}

    <div id="modal2" class="modal modal-fixed-footer">
     <form id="classForm" method="POST" action="{{ route('class.insert') }}">
        @csrf
      <div class="modal-content">

          <!-- warning msg show -->
                @if($errors->any())
                   <div class="mt-2 card-alert card gradient-45deg-amber-amber">
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
                     <div class="mt-2 card-alert card gradient-45deg-amber-amber">
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

        <div class="modal-title col m12">
            <h6 id="model-header" style="color:white;float: left;" class="">New Class Add</h6>
            <button style="float:right;" type="button" class="modal-close btn">&times;</button>
        </div>
            <div class="row mt-5">
                <div class="modal-body">

                    <div class="input-field col m12 s12">
                        <label for="class">Class Name: <span class="red-text">*</span></label>
                        <input id="class" name="class" type="text" data-error=".errorclass1"  class="validate" data-error=".errorclass1" required="">
                        <small class="errorclass1"></small>
                    </div>

                    <div class="input-field col m12 s12">
                        <label for="admission_fees">Admission Fee: <span class="red-text">*</span></label>
                        <input id="admission_fees" name="admission_fees" type="text" data-error=".erroradmission_fees1"  class="validate" data-error=".erroradmission_fees1" required="">
                        <small class="erroradmission_fees1"></small>
                    </div>

                    <div class="input-field col m12 s12">
                        <label for="monthly_fee">Monthly Fee: <span class="red-text">*</span></label>
                        <input id="monthly_fee" name="monthly_fee" type="text" data-error=".errormonthly_fee1"  class="validate" data-error=".errormonthly_fee1" required="">
                        <small class="errormonthly_fee1"></small>
                    </div>

                    <div class="input-field col m12 s12">
                        <label for="exam_fee">Exam Name: <span class="red-text">*</span></label>
                        <input id="exam_fee" name="exam_fee" type="text" data-error=".errorexam_fee1"  class="validate" data-error=".errorexam_fee1" required="">
                        <small class="errorexam_fee1"></small>
                    </div>
                </div>
            </div>

      </div>
          <div class="modal-footer">
            <button id="submitBtn" type="submit" class="btn waves-effect waves-light amber darken-4">Submit</button>
            <button type="button" class="modal-close btn">Close</button>
          </div>
        </form>
  </div>


//model-2

    <div id="modal3" class="modal modal-fixed-footer">
     <form id="classFormUpdate" method="POST" action="{{ route('class.update') }}">
        @csrf
      <div class="modal-content">

          <!-- warning msg show -->
                @if($errors->any())
                   <div class="mt-2 card-alert card gradient-45deg-amber-amber">
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
                     <div class="mt-2 card-alert card gradient-45deg-amber-amber">
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

        <div class="modal-title col m12">
            <h6 id="model-header" style="color:white;float: left;" class="">Class Edit</h6>
            <button style="float:right;" type="button" class="modal-close btn">&times;</button>
        </div>
            <div class="row mt-5">
                <div id="modeldata" class="modal-body">


                </div>
            </div>

      </div>
          <div class="modal-footer">
            <button id="submitBtn" type="submit" class="btn waves-effect waves-light amber darken-4">Update</button>
            <button type="button" class="modal-close btn">Close</button>
          </div>
        </form>
  </div>



@endsection