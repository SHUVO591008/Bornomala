@extends('layouts.BackendLayout')

@section('content')



<style>
.users-list-filter .show-btn {
    padding-top: 43px!important;
}

table label select {
    display: inline-block;
    width: auto;
    height: auto;
}

table label input {
    width: auto;
    height: auto;
    margin-left: 0.5rem;
}

h4.General.card-title {
    font-size: 18px;
    font-weight: 400;

}
h4.General.card-title {
    line-height: 32px;
    display: block;
    margin-bottom: 8px;
}


.modal-title {
    background: #110c48;
    overflow: auto;
    padding: 10px 29px;
    border-radius: 11px;
}

.select2-container {
 z-index: 99999;
}


.modal{
    width: 80%!important;
}

th {
    background: #0ef565;
    font-weight: 800!important;
    font-size: 16px;
    color: black;
}



.span-th {
    border: 2px solid black;
    border-style: dashed;
    padding: 8px;
    display: block;
}

.section_td {
    text-align: center;
    font-size: 16px;
    font-weight: bolder;
    background: #d4ff287a;
    color: black;
}
.page-item {
    background: blanchedalmond;
}


.page-link{
    padding: 0px 0px 0px 19px;
}
nav{
    margin-top: 39px;
    /* color: black; */
    text-align: center;
    background: white;
    letter-spacing: 19px;
}

.pagination li {

    height: 64px!important;

}


table td {
    text-transform: capitalize;
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
                        Course List
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





            <!-- courses settings show-->

                    <div style="height: 84px;" class=" col m12 s12">
                        <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title">Course Table
                            <a id="courseAdd" class="mb-6 btn waves-effect waves-light darken-1 modal-trigger" style="float: right;background-color: black;" href="#modal2"><i class="fas fa-plus-circle"></i> Add New</a>
                        </h4>

                        <hr>

                    </div>

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



                    <!-- Search Start-->
                    <div class="users-list-filter col s12 m12">
                        <div class="card-panel">
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
                                      <button id="SearchBtn"  class="btn btn-block indigo waves-effect waves-light">Show</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Search End-->





                    <!-- Page Length Options -->
                        <div class="row">
                                <div class="col s12">
                                <div class="card">
                                <div class="card-content">
                                  <h4 class="card-title">Course Table Show</h4>
                                  <div class="row">
                                    <div class="col s12">
                                            <!-- Ajax table -->
                                         <div id="documentResult"></div>
                                        <script id="document-template-search" type="text/x-handlebars-template">
                                            @{{{script}}}
                                            <table class="display bordered responsive-table centered" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                            @{{{header}}}
                                                        </tr>
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


                                      <table id="page-length-option" class="display bordered responsive-table centered">
                                        @if(count($course)==0)
                                                <th style="text-align: center;background: none;" colspan="6">
                                                    Data Not Found
                                                </th>
                                        @endif
                                         @foreach($course as $corsesVal)
                                            <?php
                                              $sl = 1;

                                                $GetSection = DB::table('courses')
                                                        ->join('sections','courses.section_id','sections.id')
                                                        ->where('courses.session_id',$corsesVal->session_id)
                                                        ->where('courses.class_id',$corsesVal->class_id)
                                                        ->groupBy('courses.section_id')
                                                        ->get();
                                            ?>


                                            <thead>

                                                    <tr>
                                                        <th style="text-align: center" colspan="6">
                                                            <span class="span-th">
                                                            Class : {{$corsesVal->class}}
                                                            <br>
                                                            Year : {{$corsesVal->year}}
                                                            </span>
                                                        </th>

                                                    </tr>


                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Subject</th>
                                                        <th>Fee</th>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>

                                            </thead>
                                             <tbody>

                                                @foreach ($GetSection as $section)

                                                    <?php

                                                    $GetSubject = DB::table('courses')
                                                       ->where('courses.section_id',$section->section_id)
                                                       ->where('courses.session_id',$section->session_id)
                                                        ->get();

                                                    ?>


                                                    <tr>
                                                        <td class="section_td" style="text-align: center" colspan="6">
                                                            <strong>Section :</strong> {{$section->section}}
                                                            <br>
                                                            <strong>Total Subject :</strong> {{count($GetSubject)}}

                                                        </td>
                                                    </tr>
                                                    @foreach ($GetSubject as $subject)
                                                    @php $prodID= Crypt::encrypt($subject->id); @endphp
                                                    <tr>
                                                        <td>{{$sl++}}</td>
                                                        <td>{{$subject->course_name}}</td>
                                                        <td>{{$subject->course_fee}}</td>
                                                        <td>{{$subject->course_type}}</td>
                                                        <td width="20%">
                                                            <div class="switch">
                                                                <label>
                                                                  <span>Inactive</span>
                                                                  <input data-column="{{route('course.status')}}" class="status course" data-id="{{$prodID}}" id="status" {{($subject->status==1)?'checked':''}} type="checkbox">
                                                                  <span class="lever"></span>
                                                                  <span>Active</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td width="20%">
                                                            <a id="editCourse" data-id="{{$prodID}}" class="btn-floating waves-effect waves-light amber darken-4 mr-5 modal-trigger editCourse" href="#modal3" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>


                                                            <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('course.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
                                                        </td>

                                                    </tr>
                                                    @endforeach

                                                @endforeach

                                            </tbody>
                                          @endforeach
                                      </table>

                                      {!! $course->links() !!}


                                    </div>
                                  </div>

                                </div>
                                </div>
                                </div>
                                </div>






                            </div>
                          </div>
                        </div>
            <!-- courses settings show End-->



      <!-- END: Page Main-->

    {{-- modal start here --}}

    <div  id="modal2" class="modal modal-fixed-footer">
     <form id="CourseForm" method="POST" action="{{ route('course.insert') }}">
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
            <h6 id="model-header" style="color:white;float: left;" class="">Course Add</h6>
            <button style="float:right;" type="button" class="modal-close btn">&times;</button>
        </div>
            <div class="row mt-5">
                <div class="modal-body">
                    <div class="row">

                        <div class="input-field col m12 s12">
                             <select onchange="myFunction(this)" class="select2 browser-default validate" name="class_id" id="class_id" data-error=".class_id30" required="">
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

                        <div class="input-field col m6 s6">
                            <select class="select2 browser-default validate" name="section_id" id="section_id" data-error=".section_id30" required="">
                                <option value="" disabled="" selected>Select Section</option>
                            </select>

                           <small class="section_id30"></small>
                        </div>


                         <div class="input-field col m6 s6">
                            <select class="select2 browser-default validate" name="session_id" id="session_id" data-error=".session_id30" required="">
                                <option value="" selected disabled="">Select Year</option>

                                @php
                                $year=DB::table('years')
                                    ->where('status',1)
                                    ->orderBy('year','desc')
                                    ->get();
                                @endphp
                                @foreach($year as $key)
                                <option value="{{ Crypt::encrypt($key->id) }}">{{ $key->year }}</option>
                                @endforeach
                            </select>

                           <small class="session_id30"></small>
                        </div>

                    </div>

                    <div class="addRowcourse" id="addRowcourse">
                        <div id="delete_add_more_item" class="delete_add_more_item">
                        <div id="courseDiv" class="row">
                             <div class="input-field col m3 s3">
                                <label for="course_name">Course Name: <span class="red-text">*</span></label>
                                <input id="course_name" name="course_name[]" type="text"  class="validate" data-error=".errorcourse_name1" required="">
                                <small class="errorcourse_name1"></small>

                            </div>

                            <div class="input-field col m3 s3">
                                <label for="course_fee">Course Fee: <span class="red-text">*</span></label>
                                <input id="course_fee" name="course_fee[]" type="text"  class="validate" data-error=".errorcourse_fee1" required="">
                                <small class="errorcourse_fee1"></small>
                            </div>


                            <div class="input-field col m2 s2">
                                <select class="select2 browser-default validate" name="course_type[]" id="course_type" data-error=".errorcourse_type" required="">

                                <option  value="" selected="" disabled="">Select Course Type</option>
                                <option  value="monthly">Monthly</option>
                                <option  value="daily">Daily</option>
                                <option  value="yearly">Yearly</option>

                                </select>

                                <small class="errorcourse_type"></small>
                            </div>


                            <div class="input-field col m2 s2">
                                <select class="select2 browser-default validate" name="status[]" id="status" data-error=".errorStatus" required="">

                                <option  value="" selected="" disabled="">Select Status</option>
                                <option  value="active">Active</option>

                                <option  value="inactive">Inactive</option>

                                </select>

                                <small class="errorStatus"></small>
                            </div>

                            <div class="input-field col m2 s2">

                                <div id="courseadd" class="btn-light btn courseadd"><i class="fas fa-plus-circle"></i></div>

                                <div class="red btn courseremove"><i class="fas fa-minus-circle"></i></div>
                            </div>
                        </div>

                        </div>
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
     <form id="courseFormUpdate" method="POST" action="{{ route('course.update') }}">
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
            <h6 id="model-header" style="color:white;float: left;" class="">Course Edit</h6>
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

<!-- x-handlebars-template Add/Edit Course Information-->
<script id="course-template" type="text/x-handlebars-template">

        <div class="delete_add_more_item" id="delete_add_more_item">
            <div id="courseDiv" class="row">

                 <div class="input-field col m3 s3">
                    <label for="course_name1">Course Name: <span class="red-text">*</span></label>
                    <input id="course_name1" name="course_name[]" type="text"  class="validate" data-error=".errorcourse_name0" required="">
                    <small class="errorcourse_name0"></small>

                </div>

                 <div class="input-field col m3 s3">
                    <label for="course_fee1">Course Fee: <span class="red-text">*</span></label>
                    <input id="course_fee1" name="course_fee[]" type="text"  class="validate" data-error=".errorcourse_fee0" required="">
                    <small class="errorcourse_fee0"></small>

                </div>


                 <div class="input-field col m2 s2">
                    <select class="select3 browser-default validate" name="course_type[]" id="course_type1" data-error=".errorcourse_type0">


                    <option  value="" selected="" disabled="">Select Course Type</option>
                    <option  value="monthly">Monthly</option>
                    <option  value="daily">Daily</option>
                    <option  value="yearly">Yearly</option>

                    </select>

                    <small class="errorcourse_type0"></small>
                </div>


                <div class="input-field col m2 s2">
                    <select class="select3 browser-default validate" name="status[]" id="status1" data-error=".errorStatus0" required="">

                    <option  value="" selected="" disabled="">Select Status</option>
                    <option  value="active">Active</option>

                    <option  value="inactive">Inactive</option>

                    </select>

                    <small class="errorStatus0"></small>
                </div>



                   <div class="input-field col m2 s2">

                        <div id="courseadd" class="btn-light btn courseadd"><i class="fas fa-plus-circle"></i></div>

                        <div class="red btn courseremove"><i class="fas fa-minus-circle"></i></div>

                    </div>

            </div>
      </div>
 </script>

 <script id="course-edit-template" type="text/x-handlebars-template">

        <div class="delete_Edit_more_item" id="delete_Edit_more_item">
             <div id="courseDiv" class="row">

                <div class="input-field col m3 s3">
                    <label for="course_name2">Course Name: <span class="red-text">*</span></label>
                    <input id="course_name2" name="course_name[]" type="text"  class="validate" data-error=".errorcourse_name3" required="">
                    <small class="errorcourse_name3"></small>

                </div>



                <div class="input-field col m3 s3">
                    <label for="course_fee2">Course Fee: <span class="red-text">*</span></label>
                    <input id="course_fee2" name="course_fee[]" type="text"  class="validate" data-error=".errorcourse_fee3" required="">
                    <small class="errorcourse_fee3"></small>

                </div>



                <div class="input-field col m2 s2">
                        <select class="select3 browser-default validate" name="course_type[]" id="course_type2" data-error=".errorcourse_type3" required="">

                        <option  value="" selected="" disabled="">Select Course Type</option>
                        <option  value="monthly">Monthly</option>
                        <option  value="daily">Daily</option>
                        <option  value="yearly">Yearly</option>

                        </select>

                        <small class="errorcourse_type3"></small>
                </div>




                    <div class="input-field col m2 s2">
                        <select class="select3 browser-default validate" name="status[]" id="status2" data-error=".errorStatus3" required="">

                        <option  value="" selected="" disabled="">Select Status</option>
                        <option  value="active">Active</option>

                        <option  value="inactive">Inactive</option>

                        </select>

                        <small class="errorStatus3"></small>
                    </div>



                   <div class="input-field col m2 s2">

                        <div id="courseedit" class="btn-light btn courseedit"><i class="fas fa-plus-circle"></i></div>

                        <div class="red btn courseEditremove"><i class="fas fa-minus-circle"></i></div>

                    </div>

            </div>
      </div>
 </script>
 <!-- x-handlebars-template Add/Edit Course Information End-->


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
