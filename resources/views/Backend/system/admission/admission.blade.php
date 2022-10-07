@extends('layouts.BackendLayout')

<style>
    .column-title{
        padding:10px;background: #ecebeb
    }


.column-title strong {
    font-size: 18px;
    font-weight: 700;
}


</style>

@section('content')
    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">

          <div id="breadcrumbs-wrapper" data-image="{{asset("Backend/app-assets/images/gallery/breadcrumb-bg.jpg")}}">
                <!-- Search for small screen-->
                <div class="container">
                  <div class="row">

                    <div class="col s12 m6 l6">
                      <h5 class="breadcrumbs-title mt-0 mb-0"><span>New Admission Form</span></h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('users.list') }}">Admission List</a>
                        </li>
                        <li class="breadcrumb-item active">New Admission
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

              <div class="col s12">
                
                <!-- New Admission Add -->
                <div class="container">
                    <div class="row">
                        <form id="formValidate" class="col s12" action="{{route('insert.admission')}}" method="POST"  enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div class="card-header">
                                            <h4 class="card-title"> Manage Student</h4>
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

                                            <div style="overflow: hidden;">

                                                <h5 class="column-title">
                                                    <strong>Basic Information:</strong>
                                                </h5>
                                            
                                                
                                                <div class="input-field col l3 m3 s12">
                                                    <label for="firstName">First Name: <span class="red-text">*</span></label>
                                                    <input value="{{old('firstName')}}" type="text" id="firstName" name="firstName" class="validate" required="" data-error=".errorFname">
                                                    <small class="errorFname"></small>
                                                </div>

                                                <div class="input-field col l3 m3 s12">
                                                    <label for="lastName">Last Name: <span class="red-text">*</span></label>
                                                    <input value="{{old('lastName')}}" type="text" id="lastName" class="validate" name="lastName" required="" data-error=".errorLname">
                                                    <small class="errorLname"></small>
                                                </div>



                                                <div class="input-field col l3 m3 s12">
                                                    <label for="admission_date">Admission Date: <span class="red-text">*</span></label>
                                                    <input  value="{{old('admission_date')}}" id="admission_date" name="admission_date" type="text" class="admission_date datepicker" placeholder="dd/mm/yy" required="" data-error=".erroradmission_date">
                                                    <small class="erroradmission_date"></small>
                                                </div>

                                                <div class="input-field col l3 m3 s12">
                                                    <label for="phone">Mobile: <span class="red-text">*</span></label>
                                                    <input value="{{old('phone')}}" name="phone" id="phone" type="number" class="validate" required="" data-error=".errorMobile">
                                                    <small class="errorMobile"></small>
                                                </div>

                                            </div>

                                            <div style="overflow: hidden;">
                                        
                                                <div class="input-field col l3 m3 s12">
                                                    <label for="email">Email:</label>
                                                    <input value="{{old('email')}}" type="email" class="validate" name="email" id="email" data-error=".errorEmail">
                                                    <small class="errorEmail"></small>
                                                </div>

                                                <div class="input-field col l3 m3 s12">
                                                    <select class="select2 browser-default validate" name="gender" id="gender" data-error=".errorGender" required="">

                                                    <option value="" selected>Select Gender</option>
                                                    <option {{ old('gender') == 'male' ? "selected" : "" }}  value="male">Male</option>
                                                    <option {{ old('gender') == 'female' ? "selected" : "" }} value="female">Female</option>
                                                    <option {{ old('gender') == 'other' ? "selected" : "" }} value="other">Other</option>
                                                    </select>
                                                
                                                    <small class="errorGender"></small>
                                                </div>

                                                <div class="input-field col l3 m3 s12">
                                                    <select class="select2 browser-default validate" name="religion" id="religion" required="" data-error=".errorReligion">
                                                    <option value=""  selected>Select Religion</option>
                                                    <option {{ old('religion') == 'hinduism' ? "selected" : "" }} value="hinduism">Hinduism</option>
                                                    <option {{ old('religion') == 'islam' ? "selected" : "" }} value="islam">Islam</option>
                                                    <option {{ old('religion') == 'buddhists' ? "selected" : "" }} value="buddhists">Buddhists</option>
                                                    <option {{ old('religion') == 'christianity' ? "selected" : "" }} value="christianity">Christianity</option>
                                                    </select>
                                              
                                                    <small class="errorReligion"></small>
                                                </div>


                                                <div class="input-field col l3 m3 s12">
                                                    <select class="select2 browser-default validate" name="blood_group" id="blood_group" data-error=".errorblood_group" required="">

                                                    <option value="" selected>Select Blood Group</option>
                                                    <option {{ old('blood_group') == 'A+' ? "selected" : "" }}  value="A+">A+</option>
                                                    <option {{ old('blood_group') == 'A-' ? "selected" : "" }} value="A-">A-</option>
                                                    <option {{ old('blood_group') == 'B+' ? "selected" : "" }} value="B+">B+</option>
                                                    <option {{ old('blood_group') == 'B-' ? "selected" : "" }} value="B-">B-</option>
                                                    <option {{ old('blood_group') == 'O+' ? "selected" : "" }} value="O+">O+</option>
                                                    <option {{ old('blood_group') == 'O-' ? "selected" : "" }} value="O-">O-</option>
                                                    <option {{ old('blood_group') == 'AB+' ? "selected" : "" }} value="AB+">AB+</option>
                                                    <option {{ old('blood_group') == 'AB-' ? "selected" : "" }} value="AB-">AB-</option>
                                                    </select>
                                                 
                                                    <small class="errorblood_group"></small>
                                                </div>
                                            </div>

                               
                                        <div >
                                            <div class="input-field col l3 m3 s12">
                                                <label for="dob">Date Of Birth <span class="red-text">*</span></label>
                                                <input value="{{old('dob')}}" id="dob" name="dob" type="text" class="birthdate-picker " placeholder="dd/mm/yy" required="" data-error=".errorDatepicker">
                                                <small class="errorDatepicker"></small>
                                            </div>

                                            
                                            <div class="input-field file-field col l6 m6 s12">
                                                <div class="btn float-right">
                                                  <span>Image: </span><span class="red-text">*</span>
                                                  <input class="upload" name="image" type="file" accept="image/*" onchange="readURL(this);">
                                                </div>

                                                <div class="file-path-wrapper">
                                                    <input name="image" class="file-path validate upload" type="text" required="" data-error=".errorImage" accept="image/*" onchange="readURL(this);">
                                                     <small style="display: none;" class="errorImage"></small>
                                                </div>
                                            </div>

                                            <div class="input-field col l3 m3 s12">
                                                <div style="text-align: center;" class="">
                                                    <img style="max-width: 44%;width:44%;height: 160px" id="image" src="{{asset('Backend/Extra_image/no_image.jpg')}}" />
                                                </div>
                                            </div>

                                        </div>

                                          </div>

                                 
                                

                                        <div class="row">
                                           <div style="overflow: hidden;">
                                            <h5 class="column-title">
                                                <strong>Academic Information:</strong>
                                            </h5>
                                           

                                            <div class="input-field col l4 m4 s12">
                                                <select onchange="myFunction(this)" class="select2 browser-default validate" name="class_id" id="class_id" required="" data-error=".errorclass_id">
                                                <option value=""  selected>Select Class</option>

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
                                                
                                                <small class="errorclass_id"></small>
                                            </div>

                                            


                                            <div class="input-field col m4 l4 s12">
                                                <select class="select2 browser-default validate" name="section_id" id="section_id" data-error=".section_id" required="">
                                                    <option value="" disabled="" selected>Select Section</option>
                                                </select>

                                                    <small class="section_id"></small>
                                            </div>

                                            <div class="input-field col l4 m4 s12">
                                                <select class="select2 browser-default validate" name="year_id" id="year_id" required="" data-error=".erroryear_id">
                                                <option value=""  selected disabled="">Select Year</option>

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
                                             
                                                <small class="erroryear_id"></small>
                                            </div>
                                        </div>

                                         <div style="overflow: hidden;">

                                            <div class="input-field col l4 m4 s12">
                                                <select class="select2 browser-default validate" name="scholarship" id="scholarship" required="" data-error=".errorscholarship">
                                                <option value=""  selected disabled="">Select Scholarship</option>
                                                <option {{ old('scholarship') == 'full_fee' ? "selected" : "" }} value="full_fee">Full Fee</option>
                                                <option {{ old('scholarship') == 'half_fee' ? "selected" : "" }} value="half_fee">Half Fee</option>
                                            
                                                </select>
                                                
                                                <small class="errorscholarship"></small>
                                            </div>

                                             <div class="input-field col l4 m4 s12">
                                                <label id="class_label" for="admission_fee">Admission Fee<span class="red-text">*</span></label>
                                                <input value="{{old('admission_fee')}}" id="admission_fee" name="admission_fee" type="number" class="validate" required="" data-error=".erroradmission_fee" readonly="">
                                                <small class="erroradmission_fee"></small>
                                            </div>

                                             <div class="input-field col l4 m4 s12">
                                                <label for="discount">Discount (%)</label>
                                                <input value="{{old('discount')}}" id="discount" name="discount" type="number" class="validate" required="" data-error=".errordiscount" >
                                                <small class="errordiscount"></small>
                                            </div>


                                        </div>
                                        </div>

                                        <div class="row">
                                            
                                            <h5 class="column-title">
                                                <strong>Father Information:</strong>
                                            </h5>
                                            


                                            <div class="input-field col l5 m5 s12">
                                                <label for="father_name">Father Name<span class="red-text">*</span></label>
                                                <input value="{{old('father_name')}}" id="father_name" name="father_name" type="text" class="validate" required="" data-error=".errorfather_name">
                                                 <small class="errorfather_name"></small>
                                            </div>


                                            <div class="input-field col l7 m7 s12">
                                                <label for="father_occupation">Father Occupation<span class="red-text">*</span></label>
                                                <input value="{{old('father_occupation')}}" id="father_occupation" name="father_occupation" type="text" class="validate" required="" data-error=".errorfather_occupation">
                                                 <small class="errorfather_occupation"></small>
                                            </div>
                                        </div>

                                        <div class="row">
                                            
                                            <h5 class="column-title">
                                                <strong>Mather Information:</strong>
                                            </h5>
                                            

                                            <div class="input-field col l5 m5 s12">
                                                <label for="mother_name">Mother Name<span class="red-text">*</span></label>
                                                <input value="{{old('mother_name')}}" id="mother_name" name="mother_name" type="text"  class="validate" required="" data-error=".errormother_name">
                                                <small class="errormother_name"></small>
                                            </div>

                                            <div class="input-field col l7 m7 s12">
                                                <label for="mother_occupation">Mother Occupation<span class="red-text">*</span></label>
                                                <input value="{{old('mother_occupation')}}" id="mother_occupation" name="mother_occupation" type="text" class="validate" required="" data-error=".errormother_occupation">
                                                <small class="errormother_occupation"></small>
                                            </div>
                                        </div>

                                        <div class="row">
                                           
                                            <h5 class="column-title">
                                                <strong>Guardian Information:</strong>
                                            </h5>
                                            

                                             <div class="input-field col l3 m3 s12">
                                                <label for="gurdian_mobile">Gurdian Mobile: <span class="red-text">*</span></label>
                                                <input value="{{old('gurdian_mobile')}}" name="gurdian_mobile" id="gurdian_mobile" type="number" class="validate" required="" data-error=".errorgurdian_mobile">
                                                <small class="errorgurdian_mobile"></small>
                                            </div>

                                            <div class="input-field col l3 m3 s12">
                                                <label for="nid_number">Gurdian NID: <span class="red-text">*</span></label>
                                                <input value="{{old('nid_number')}}" name="nid_number" id="nid_number" type="number" class="validate" required="" data-error=".errornid_number">
                                                <small class="errornid_number"></small>
                                            </div>

                                            <div class="input-field file-field col l3 m3 s12">
                                                <div class="btn float-right">
                                                  <span>Image: </span><span class="red-text">*</span>
                                                  <input class="upload" name="gurdian_image" type="file" accept="image/*" onchange="gurdianImage(this);">
                                                </div>

                                                <div class="file-path-wrapper">
                                                    <input name="gurdian_image" class="file-path validate upload" type="text" required="" data-error=".gurdian" accept="image/*" onchange="gurdianImage(this);">
                                                     <small style="display: none;" class="gurdian"></small>
                                                </div>

                                            </div>

                                            <div class="input-field col l3 m3 s12">
                                                <div style="text-align: center;" class="">
                                                    <img style="max-width: 44%;width:44%;height: 160px" id="gurdian" src="{{asset('Backend/Extra_image/no_image.jpg')}}" />
                                                </div>
                                            </div> 
                                        </div>


                                        <div class="row">
                                            
                                            <h5 class="column-title">
                                                <strong>Address Information:</strong>
                                            </h5>
                                            


                                  
                                            <div class="input-field col l4 m4 s12">
                                                <select  class="validate" name="city" id="city" required="" data-error=".errorCity">
                                                  <option value="bangladesh">Bangladesh</option>
                                                </select>
                                                <label>Country: <span class="red-text">*</span></label>
                                                <small class="errorCity"></small>
                                            </div>

                                            <div class="input-field col l4 m4 s12">
                                                <label for="address1">Present address <span class="red-text">*</span></label>
                                                <input value="{{old('address1')}}" id="address1" name="address1" type="text" class="validate" required="" data-error=".errorAddress1">
                                            <small class="errorAddress1"></small>
                                            </div>

                                            <div class="input-field col l4 m4 s12">
                                                <label for="address2">Permanent  address <span class="red-text">*</span></label>
                                                <input value="{{old('address2')}}" id="address2" name="address2" type="text" class="validate" required="" data-error=".errorAddress2">
                                                <small class="errorAddress2"></small>
                                            </div>
                                        </div>

                                        <div class="row">
                        
                                            <h5 class="column-title">
                                                <strong>School/Collage Information:</strong>
                                            </h5>
                                           

                                            <div class="input-field col l8 m8 s12">
                                                <label for="school_collage">School/Collage Name<span class="red-text">*</span></label>
                                                <input value="{{old('school_collage')}}" id="school_collage" name="school_collage" type="text" class="validate" required="" data-error=".errorschool_collage">
                                                <small class="errorschool_collage"></small>
                                            </div>

                                            <div class="input-field col l4 m4 s12">
                                                <label for="school_collage_class">Class Name<span class="red-text">*</span></label>
                                                <input value="{{old('school_collage_class')}}" id="school_collage_class" name="school_collage_class" type="text" class="validate" required="" data-error=".errorschool_collage_class">
                                                <small class="errorschool_collage_class"></small>
                                            </div>
                                        </div>

                                        <div class="row">
                                           
                                            <h5 class="column-title">
                                                <strong>Social Information:</strong>
                                            </h5>
                                            

                                                <div class="addRow" id="addRow">
                                            <div id="delete_add_more_item" class="delete_add_more_item">
                                                    <div class="row">
                                                        <div class="input-field col m3 s6">
                                                             
                                                                <select class="select2 browser-default validate" name="socialicon[]" id="socialicon" data-error=".socialicon30" required="">
                                                                    <option value="" selected> <i class="fab fa-twitter"></i> Select Social Link</option>
                                                                    <option {{ old('socialicon.0') == 'facebook' ? "selected" : "" }}  value="facebook">Facebook</option>
                                                                    <option {{ old('socialicon.0') == 'twitter' ? "selected" : "" }}  value="twitter">Twitter</option>
                                                                    <option {{ old('socialicon.0') == 'linkedIn' ? "selected" : "" }}  value="linkedIn">LinkedIn</option>
                                                            <option {{ old('socialicon.0') == 'instagram' ? "selected" : "" }}  value="instagram">Instagram</option>      
                                                                </select>

                                                           <small class="socialicon30"></small>
                                                        </div>

                                                        <div class="input-field col m7 s12">
                                                            <label>Url</label>
                                                            <input value="{{old('socialUrl.0')}}"  name="socialUrl[]" class="validate" type="url">
                                                        </div>




                                                        <div class="input-field col m2 s6">
                                                            <div id="add" class="btn-light btn add"><i class="fas fa-plus-circle"></i></div>

                                                            <div class="red btn removeeventmore"><i class="fas fa-minus-circle"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="row ">
                                            
                                            <h5 class="column-title">
                                                <strong>Other Information:</strong>
                                            </h5>
                                            

                                            <div class="input-field col l3 m3 s12">
                                                <label for="username">Username: <span class="red-text">*</span></label>
                                                <input value="{{old('username')}}" id="username" name="username" type="text" class="validate" data-error=".errorusername" required="">
                                                <small class="errorusername"></small>
                                            </div>

                                            

                                            <div class="input-field col l3 m3 s12 last">
                                                <select class="validate" name="status" id="status" data-error=".errorTxt35" required="">
                                                  <option  value="" disabled selected>Select Status</option>
                                                  <option {{ old('status') == 'active' ? "selected" : "" }} value="active">Active</option>
                                                  <option {{ old('status') == 'inactive' ? "selected" : "" }} value="inactive">Inactive</option>
                                                </select>
                                                <label>Status: <span class="red-text">*</span></label>
                                                <small class="errorTxt35"></small>
                                            </div>

                                            <div class="input-field col l3 m3 s12">
                                                <label for="password">Password <span class="red-text">*</span></label>
                                                <input id="password" type="password" name="password" data-error=".errorTxt3" required="">
                                                <small class="errorTxt3"></small>
                                            </div>

                                            <div class="input-field col l3 m3 s12">
                                                <label for="cpassword">Confirm Password <span class="red-text">*</span></label>
                                                <input id="cpassword" type="password" name="cpassword" data-error=".errorTxt4" required="">
                                                <small class="errorTxt4"></small>
                                            </div>

                                            <div class="input-field col l12 m12 s12">
                                                <label for="about">Other Info </label>
                                                <input value="{{old('about')}}" id="about" name="about" type="text" data-error=".errorabout">
                                                <small class="errorabout"></small>
                                            </div>
                                        </div>


                                       

                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="submit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit">Submit
                                                </button>
                                            </div>
                                        </div>

                              </div>
                          </div>
                        </form>
                    </div>
                </div>
                <!-- user Add End-->
              </div>

        </div>
    </div>
      <!-- END: Page Main-->



<script type="text/javascript">


    //Student Image Live Show
    function readURL(input){
       
        if(input.files.length==1){

            if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image')
                .attr('src',e.target.result)
                .width(773)
                .height(160);
                };
                reader.readAsDataURL(input.files[0]);
            }

        }else{
            var loadImage =  '<?php echo asset("Backend/Extra_image/no_image.jpg") ?>';
            $('#image')
            .attr('src',loadImage)
            .width(773)
            .height(160);
                   
        }

        
    }


        //Gurdian Image Live Show
    function gurdianImage(input){
       
        if(input.files.length==1){

            if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#gurdian')
                .attr('src',e.target.result)
                .width(773)
                .height(160);
                };
                reader.readAsDataURL(input.files[0]);
            }

        }else{
            var loadImage =  '<?php echo asset("Backend/Extra_image/no_image.jpg") ?>';
            $('#gurdian')
            .attr('src',loadImage)
            .width(773)
            .height(160);
                   
        }

        
    }



// section add function
function myFunction(argument) {
    var class_id = argument.value;

 

    if(!class_id){

        $('#section_id').html('<option disabled selected value="">Select Section</option>');
        $('#class_label').removeClass('active');
        $('#admission_fee').val("");
    }

    // get section

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
    });

    // get fee
    $.ajax({
        type:"GET",
        url:"/admission/fee",
        data:{class_id:class_id},
        success:function(data){
           $('#class_label').addClass('active');
            
            $('#admission_fee').val(data.admission_fees);
        }
    })

}

</script>      

<!-- x-handlebars-template social Information-->
<script id="document-template" type="text/x-handlebars-template">

        <div class="delete_add_more_item " id="delete_add_more_item">
           <div id="socialiconselect2" class="row">
                <div class="input-field col m3 s6 ">
                    <select class="select3 browser-default validate " name="socialicon[]" id="socialicon2" data-error=".socialicon0" >
                        <option value="" selected>Select Social Link</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="linkedIn">LinkedIn</option>
                        <option value="instagram">Instagram</option>
                        
                    </select>
                     <small class="socialicon0"></small>
                </div>
                <div class="input-field col m7 s12">
                    <label>Url</label>
                    <input id="url" class="validate" type="url" name="socialUrl[]" data-error=".urlerror" >
                     <small class="urlerror"></small>
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
