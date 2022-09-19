@extends('layouts.BackendLayout')

@section('content')



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

.select2-container {
 z-index: 99999;
}


strong{
    font-weight: bold;
    font-size: 17px;
    color: black;
        background: #a2ed14;
    border-style: dashed;
    padding: 10px;
    border-color: chocolate;
}

.total_subject {
    border-style: solid;
    padding: 5px;
    background: blanchedalmond;
    color: black;
    font-size: 16px;
    font-weight: bold;
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
                        Subject List
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

   
            <!-- Sebjuct settings show-->
              <div class="users-list-table">
                  <div class="card">
                    <div class="card-content">
                        <div  class="card-header col m12 s12">
                            <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Subject Table
                                <a id="subjectAdd" class="mb-6 btn waves-effect waves-light darken-1 modal-trigger" style="float: right;background-color: black;" href="#modal2"><i class="fas fa-plus-circle"></i> Add New</a>
                            </h4>

                            <hr>

                           
                        </div>



                      <!-- Page Length Options -->
                        <div class="row">
                        <div class="col s12">
                        <div class="card">
                        <div class="card-content">
                          <h4 class="card-title">Subject Table Show</h4>
                          <div class="row">
                            <div class="col s12">
                              <table id="page-length-option" class="display bordered responsive-table">
                                <thead>
                                  <tr>
                                        <th>SL</th>
                                        <th>Section Name</th>
                                        <th>Subject Name</th>
                                        <th>Action</th>
                                  </tr>
                                </thead>
                                 <tbody>
                                 @foreach($subject as $key)
                                        <tr>
                                            <th style="text-align:center;" colspan="4"><strong>#Class Name: {{$key->class }}</strong></th>
                                     
                                     
                                        </tr>

                                        <?php 
                                             $sl = 1;
                                            $sectionData = DB::table('subjects')
                           
                                            ->join('sections','subjects.section_id','sections.id')
                                           ->where('subjects.class_id',$key->class_id)
                                            ->groupBy('subjects.section_id')
                                            ->get();

                                        ?>
                                @foreach($sectionData as $key)
                                    @php $prodID= Crypt::encrypt($key->section_id); @endphp

                                        <tr>
                                            <td >{{$sl++}}</td>
                                             <td>{{$key->section}}</td>
                                             <td width="60%">
                                            <?php 

                                          
                                             
                                            $subject = DB::table('subjects')
                                           ->where('subjects.section_id',$key->section_id)
                                            ->get();
                                             ?>

                                              <span class="total_subject">Total Subject : {{count($subject)}}</span> 
                                                <br>
                                                <br>

                                            @foreach($subject as $key)
                                                {{$key->subject_name}}-{{$key->subject_code}} {{ $loop->last ? '' : ',' }}
                                              
                                            @endforeach
                                           

                                         

                                            </td>
                                             <td width="10%">
                                                 <a id="editSubject" data-id="{{$prodID}}" class="btn-floating waves-effect waves-light amber darken-4 mr-5 modal-trigger editSubject" href="#modal3" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a> 

                                                <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('subject.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
                                             </td>
                                        </tr>

                                @endforeach

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
            <!-- Subject settings show End-->


        </div>
    </div>
      <!-- END: Page Main-->

    {{-- modal start here --}}

    <div id="modal2" class="modal modal-fixed-footer">
     <form id="SubjectForm" method="POST" action="{{ route('subject.insert') }}">
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
            <h6 id="model-header" style="color:white;float: left;" class="">Subject Add</h6>
            <button style="float:right;" type="button" class="modal-close btn">&times;</button>
        </div>
            <div class="row mt-5">
                <div class="modal-body">

                    <div class="input-field col m12 s12">
                         <select onchange="myFunction(this)" class="select2 browser-default validate" name="class_id" id="class_id" data-error=".class_id30" required="">
                            <option value="" selected disabled="">Select Class</option>

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

                    <div class="input-field col m12 s12">
                        <select class="select2 browser-default validate" name="section_id" id="section_id" data-error=".section_id30" required="">
                            <option value="" selected>Select Section</option>
                        </select>

                       <small class="section_id30"></small>
                    </div>


                    <div class="addRowsubject" id="addRowsubject">
                        <div id="delete_add_more_item" class="delete_add_more_item">

                             <div class="input-field col m5 s5">
                                <label for="subject_name">Subject Name: <span class="red-text">*</span></label>
                                <input id="subject_name" name="subject_name[]" type="text"  class="validate" data-error=".errorsubject_name1" required="">
                                <small class="errorsubject_name1"></small>
                               
                            </div>

                            <div class="input-field col m4 s4">
                                <label for="subject_code">Subject Code: <span class="red-text">*</span></label>
                                <input id="subject_code" name="subject_code[]" type="text"  class="validate" data-error=".errorsubject_code1" required="">
                                <small class="errorsubject_code1"></small>
                               
                            </div>

                            <div class="input-field col m3 s3">

                                <div id="subjectadd" class="btn-light btn subjectadd"><i class="fas fa-plus-circle"></i></div>

                                <div class="red btn subjectremove"><i class="fas fa-minus-circle"></i></div>
                               
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
     <form id="subjectFormUpdate" method="POST" action="{{ route('subject.update') }}">
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
            <h6 id="model-header" style="color:white;float: left;" class="">Subject Edit</h6>
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

<!-- x-handlebars-template Add Subject Information-->
<script id="subject-template" type="text/x-handlebars-template">

        <div class="delete_add_more_item" id="delete_add_more_item">
            <div id="subjectDiv" class="row">
                 <div class="input-field col m5 s5">
                    <label for="">Subject Name: <span class="red-text">*</span></label>
                    <input id="subject_name1" name="subject_name[]" type="text"  class="validate" data-error=".errorsubject_name0" required="">
                    <small class="errorsubject_name0"></small>
                   
                </div>

                <div class="input-field col m4 s4">
                    <label for="">Subject Code: <span class="red-text">*</span></label>
                    <input id="subject_code1" name="subject_code[]" type="text"  class="validate" data-error=".errorsubject_code0" required="">
                    <small class="errorsubject_code0"></small>
                   
                </div>

                <div class="input-field col m3 s3">

                    <div  id="subjectadd" class="btn-light btn subjectadd"><i class="fas fa-plus-circle"></i></div>

                    <div  class="red btn subjectremove"><i class="fas fa-minus-circle"></i></div>
                   
                </div>

            </div>
      </div>
 </script>

 <script id="subject-edit-template" type="text/x-handlebars-template">

        <div class="delete_Edit_more_item" id="delete_Edit_more_item">
            <div id="subjectDiv" class="row">
                 <div class="input-field col m5 s5">
                    <label for="">Subject Name: <span class="red-text">*</span></label>
                    <input id="subject_name2" name="subject_name[]" type="text"  class="validate" data-error=".errorsubject_name3" required="">
                    <small class="errorsubject_name3"></small>
                   
                </div>

                <div class="input-field col m4 s4">
                    <label for="">Subject Code: <span class="red-text">*</span></label>
                    <input id="subject_code2" name="subject_code[]" type="text"  class="validate" data-error=".errorsubject_code3" required="">
                    <small class="errorsubject_code3"></small>
                   
                </div>

                <div class="input-field col m3 s3">

                    <div  id="subjectedit" class="btn-light btn subjectedit"><i class="fas fa-plus-circle"></i></div>

                    <div  class="red btn subjectEditremove"><i class="fas fa-minus-circle"></i></div>
                   
                </div>

            </div>
      </div>
 </script>
 <!-- x-handlebars-template Add Subject Information End-->



<!-- ajax -->
<script>
// section add function
function myFunction(argument) {
    var class_id = argument.value;


    $.ajax({
        type:"GET",
        url:"/subject/get-section-name",
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

// section Edit function
function myFunctionEdit(argument) {
    var class_id = argument.value;


    $.ajax({
        type:"GET",
        url:"/subject/get-section-name",
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