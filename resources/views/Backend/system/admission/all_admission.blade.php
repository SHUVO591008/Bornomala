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


.avatar {
  background-color: #aaa;
  border-radius: 50%;
  color: #fff;
  display: inline-block;
  font-weight: 500;
  height: 38px;
  line-height: 38px;
  margin: 0 10px 0 0;
    margin-right: 10px;
  text-align: center;
  text-decoration: none;
  text-transform: uppercase;
  vertical-align: middle;
  width: 38px;
  position: relative;
  white-space: nowrap;
}

.avatar > img {
  border-radius: 50%;
  display: block;
  overflow: hidden;
  width: 100%;
  height: 39px;
}

table.table td h2.table-avatar {
  align-items: center;
  display: inline-flex;
  font-size: inherit;
  font-weight: 400;
  margin: 0;
  padding: 0;
  vertical-align: middle;
  white-space: nowrap;
}

table.table td h2 span {
  color: #888;
  display: block;
  font-size: 12px;
  margin-top: 3px;
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
                        All Admission List
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item active">All Admission
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>


            <!-- All admission  settings show-->

            <div class="card">
                <div class="card-content">
                    <section class="users-list-wrapper section">

                            
                                <div  class="col m12 s12">
                                    
                                    <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">All Admission Table
                                       
                                        <a href="{{ route('new.admission') }}" class="btn waves-effect waves-light darken-1" style="float: right;background-color: black;"> <i class="fas fa-plus-circle"></i> New Admission</a>
                                    </h4>

                                    <hr>
                                    
                                </div>

                                <?php
                                    $today_admission=DB::table('admissions')->whereDate('admissions.created_at',\Carbon\Carbon::today())->get();
                                    $active_stu =  DB::table('admissions')->where('status','active')->get();
                                    $inactive_stu =  DB::table('admissions')->where('status','inactive')->get();
                                ?>

                               
                                
                            <div class="header_div col m12 s12 l12 pb-2">
                                <div class="row">
                                    <div style="text-align: center" class="col m3 s3 l3">
                                        <span style="float: none;padding:5px" class="">Today Admission Student:{{count($today_admission)}}</span>
                                    </div>

                                    <div style="text-align: center" class="col m3 s3 l3">
                                        <span style="float: none;padding:5px" class="">Active Student:{{count($active_stu)}}</span>
                                    </div>

                                    <div style="text-align: center" class="col m3 s3 l3">
                                        <span style="float: none;padding:5px" class="">Inactive Student:{{count($inactive_stu)}}</span>
                                    </div>
                                    <div style="text-align: center" class="col m3 s3 l3">
                                        <span style="float: none;padding:5px" class="">Total Student:{{count($data)}}</span>
                                    </div>
                                </div>

                                <hr>
                            </div>
                             

                                {{-- <i class="fas fa-plus-circle"></i> --}}

                        <!-- alert msg -->
                            <div class="col m12 s12">
                                <div id="msg_div" style="display:none;" class="card-alert card gradient-45deg-light-blue-cyan">
                                    <div   class="card-content white-text">
                                    <p>
                                        <i class="material-icons">info_outline</i> INFO :
                                        <span id="res_message">

                                        </span>
                                    </p>
                                    </div>
                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>

                            </div>
                        <!-- alert msg end-->

                        <div class="users-list-filter">
                        <div class="">
                            <div class="row">
                                  <form id="searchForm" action="javascript:void(0)">

                                        <div class="col s12 m6 l3">
                                          <label for="users-list-verified">Class</label>
                                          <div style="z-index: 0;" class="input-field">

                                             <select onchange="searchFunction(this)" class="select2 browser-default validate" name="class_id" id="class_id30" data-error=".class_id30" required="">
                                                <option value="" selected >Select Class</option>

                                                @php
                                                $class=DB::table('classes')
                                                    ->join('sections','classes.id','sections.class_id')
                                                    ->groupBy('sections.class_id')
                                                    ->select('classes.*')
                                                    ->get();
                                                @endphp
                                                @foreach($class as $key)
                                                <option value="{{ Crypt::encrypt($key->id) }}">{{ $key->class }}</option>
                                                @endforeach

                                            </select>

                                             <small class="class_id30"></small>

                                          </div>
                                        </div>


                                        <div class="col s12 m6 l3">
                                          <label for="users-list-verified">Section</label>
                                              <div style="z-index: 0;" class="input-field">

                                                <select class="select2 browser-default validate" name="section_id" id="section_id30" data-error=".section_id30" required="">
                                                    <option value="" disabled="" selected>Select Section</option>
                                                </select>

                                               <small class="section_id30"></small>
                                            </div>
                                        </div>


                                       <div class="col s12 m6 l3">
                                          <label for="users-list-verified">Year</label>
                                              <div style="z-index: 0;" class="input-field">

                                            <select class="select2 browser-default validate" name="session_id" id="year" data-error=".year30" required="">
                                                <option value="" selected disabled="">Select Year</option>

                                                @php
                                                $year=DB::table('years')
                                                    ->orderBy('year','desc')
                                                    ->get();
                                                @endphp
                                                @foreach($year as $key)
                                                <option value="{{ Crypt::encrypt($key->id) }}">{{ $key->year }}</option>
                                                @endforeach
                                            </select>

                                           <small class="year30"></small>

                                          </div>
                                       </div>

                                        <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                                          <button id="admissionSearchBtn"  class="btn btn-block indigo waves-effect waves-light">Show</button>
                                        </div>

                                    </form>

                            </div>
                        </div>
                        </div>

                        <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                            <!-- datatable start -->
                            <div class="responsive-table">

                                  <!-- Ajax table -->
                                  <div id="documentResult"></div>
                                  <script id="admission-template-search" type="text/x-handlebars-template">
                                      @{{{script}}}
                                      <table class="table display bordered responsive-table centered" style="width: 100%">
                                              <thead>
                                            
                                                  <tr>
                                                    @{{{thsource}}}
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  @{{#each this}}
                                                  <tr>
                                                      @{{{tdsource}}}
                                                  </tr>
                                                  @{{/each}}
                                              </tbody>
                                      </table>

                                  </script>
                                   <!-- Ajax table end-->

                                <table id="page-length-option" class="table responsive-table bordered centered">
                                <thead>
                                    <tr>

                                        <th>SL</th>
                                        <th>User Name </th>
                                        <th>Name</th>
                                        <th>Email/phone</th>
                                        <th>Gender</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Year</th>
                                        <th>Age</th>
                                        <th>Admission Date</th>

                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($data as $key)
                                    @php $UserID= Crypt::encrypt($key->id); @endphp
                                    <tr>

                                    <td>{{ $sl++ }}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a class="avatar" href="">
                                            <img class="" src="{{asset($key->student_image)}}">

                                            </a>
                                            <a href="">
                                            {{$key->user_name}}
                                            <span>{{$key->student_id}}</span>
                                            </a>

                                        </h2>
                                    </td>
                                    <td>
                                        {{ $key->first_name }} {{ $key->last_name }}
                                    </td>
                                    <td>
                                   
                                        {{ ($key->email==null)?'': $key->email}}
                                        <span style="display:block">S.Mobile: {{ ($key->mobile==null)?'N/A': $key->mobile}}  </span>
                                        <span style="display:block">G.Mobile:{{ ($key->mobile==null)?'N/A': $key->gurdian_mobile}}</span>
                                    </td>
                                    <td>{{$key->gender}}</td>
                                    <td>{{ $key->class }}</td>
                                    <td>{{ $key->section }}</td>
                                    <td>{{ $key->year }}</td>

                                    {{-- {{ \Carbon\Carbon::parse($key->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }} --}}


                                    <td>{{ \Carbon\Carbon::parse($key->dob)->age }} Years</td>


                                    <td>

                                        {{\Carbon\Carbon::parse($key->admission_date)->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        <div class="switch">
                                            <label>
                                            <span>Inactive</span>
                                            <input data-column="{{route('status.admission')}}" class="status" data-id="{{$UserID}}" id="status" {{($key->status=="active")?'checked':''}} type="checkbox">
                                            <span class="lever"></span>
                                            <span>Active</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <a title="Edit" style="margin-right: 10px;" href="{{route('admission.edit',$UserID)}}"><i class="material-icons">edit</i></a>

                                        <a style="margin-right: 10px;" title="View" href="{{route('admission.view',$UserID)}}"><i class="material-icons">remove_red_eye</i></a>

                                        @if(!$key->email==null)
                                        <a style="margin-right: 10px;" class="" title="Email" href=""><i style="font-size: 19px;" class=" fa-solid fa-envelope-open-text"></i></a>
                                        @endif

                                        @if(!$key->mobile==null || !$key->gurdian_mobile==null)
                                        <a style="margin-right: 10px;" class="" title="SMS" href=""><i style="font-size: 19px;" class="fa-solid fa-comment-sms"></i></a>
                                        @endif



                                        <a class="material-icons delete-confirm" href="{{ route('news.delete',$UserID) }}" title="Delete"><i style="font-size: 19px;" class="fa-solid fa-trash-can"></i></a>

                                    </td>



                                    </tr>
                                @endforeach

                                </tbody>
                                </table>
                            </div>
                            <!-- datatable ends -->

                            </div>
                        </div>
                        </div>
                    </section>
                </div>
            </div>



            <!-- today admission settings show End-->


        </div>
    </div>
      <!-- END: Page Main-->

<!-- ajax -->
<script>
// section add function
function myFunction(argument) {
    var class_id = argument.value;

    if(!class_id.value){
        $('#section_id').html('<option disabled selected value="">Select Section</option>');
    }

    $.ajax({
        type:"GET",
        url:"/course/get-section-name",
        data:{class_id:class_id},
        success:function(data){
            var html = '<option disabled selected value="">Select Section</option>';
            $.each(data,function(key,v){



                html +='<option value="'+v.id+'">'+v.section+'</option>';
            });
            $('#section_id').html(html);
        }
    })

}


// section search add function
function searchFunction(argument) {
    var class_id = argument.value;

      if(!class_id.value){
        $('#section_id30').html('<option disabled selected value="">Select Section</option>');
       }

    $.ajax({
        type:"GET",
        url:"/course/get-section-name",
        data:{class_id:class_id},
        success:function(data){
            var html = '<option disabled selected value="">Select Section</option>';
            $.each(data,function(key,v){



                html +='<option value="'+v.id+'">'+v.section+'</option>';
            });

            $('#section_id30').html(html);

        }
    })

}

// section Edit function
function myFunctionEdit(argument) {
    var class_id = argument.value;

     if(!class_id.value){
        $('#section_idEdit').html('<option disabled selected value="">Select Section</option>');
    }

    $.ajax({
        type:"GET",
        url:"/course/get-section-name",
        data:{class_id:class_id},
        success:function(data){
            var html = '<option disabled selected value="">Select Section</option>';
            $.each(data,function(key,v){



                html +='<option value="'+v.id+'">'+v.section+'</option>';
            });
            $('#section_idEdit').html(html);
        }
    })

}

</script>



@endsection
