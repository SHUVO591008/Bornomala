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
                      <h5 class="breadcrumbs-title mt-0 mb-0"><span>User Add</span></h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('users.list') }}">User</a>
                        </li>
                        <li class="breadcrumb-item active">Users Add
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

              <div class="col s12">
                
                <!-- user Add -->
                <div class="container">
                    <div class="row">
                        <form id="formValidate" class="col s12" action="{{route('users.store')}}" method="POST"  enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div class="card-header">
                                            <h4 class="card-title">User Informataion Add</h4>
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
                                            <div class="input-field col m6 s12">
                                                <label for="username">Username: <span class="red-text">*</span></label>
                                                <input value="{{old('username')}}" id="username" name="username" type="text" class="validate" data-error=".errorusername" required="">
                                                <small class="errorusername"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="firstName">First Name: <span class="red-text">*</span></label>
                                                <input value="{{old('firstName')}}" type="text" id="firstName" name="firstName" class="validate" required="" data-error=".errorFname">
                                                <small class="errorFname"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="lastName">Last Name: <span class="red-text">*</span></label>
                                                <input value="{{old('lastName')}}" type="text" id="lastName" class="validate" name="lastName" required="" data-error=".errorLname">
                                            <small class="errorLname"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="phone">Mobile: <span class="red-text">*</span></label>
                                                <input value="{{old('phone')}}" name="phone" id="phone" type="number" class="validate" required="" data-error=".errorMobile">
                                                <small class="errorMobile"></small>
                                            </div>
                                        </div>

                                       <div class="row">
                                            <div class="input-field col m6 s12">
                                                <label for="email">Email: <span class="red-text">*</span></label>
                                                <input value="{{old('email')}}" type="email" class="validate" name="email" id="email" data-error=".errorEmail">
                                                <small class="errorEmail"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <select class="validate" name="gender" id="gender" data-error=".errorGender" required="">

                                                <option value="" selected>Select Gender</option>
                                                <option {{ old('gender') == 'male' ? "selected" : "" }}  value="male">Male</option>
                                                <option {{ old('gender') == 'female' ? "selected" : "" }} value="female">Female</option>
                                                <option {{ old('gender') == 'other' ? "selected" : "" }} value="other">Other</option>
                                                </select>
                                                <label>Gender: <span class="red-text">*</span></label>
                                                <small class="errorGender"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <select class="validate" name="religion" id="religion" required="" data-error=".errorReligion">
                                                <option value=""  selected>Select Religion</option>
                                                <option {{ old('religion') == 'hinduism' ? "selected" : "" }} value="hinduism">Hinduism</option>
                                                <option {{ old('religion') == 'islam' ? "selected" : "" }} value="islam">Islam</option>
                                                <option {{ old('religion') == 'buddhists' ? "selected" : "" }} value="buddhists">Buddhists</option>
                                                <option {{ old('religion') == 'christianity' ? "selected" : "" }} value="christianity">Christianity</option>
                                                </select>
                                                <label>Religion: <span class="red-text">*</span></label>
                                                <small class="errorReligion"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="dob">Birth date: <span class="red-text">*</span></label>
                                                <input value="{{old('dob')}}" id="dob" name="dob" type="text" class="birthdate-picker datepicker" placeholder="Pick a birthday" required="" data-error=".errorDatepicker">
                                                <small class="errorDatepicker"></small>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <select  class="validate" name="city" id="city" required="" data-error=".errorCity">
                                                  <option value="bangladesh">Bangladesh</option>
                                                </select>
                                                <label>Country: <span class="red-text">*</span></label>
                                                <small class="errorCity"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="address1">Present address <span class="red-text">*</span></label>
                                                <input value="{{old('address1')}}" id="address1" name="address1" type="text" class="validate" required="" data-error=".errorAddress1">
                                            <small class="errorAddress1"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="address2">Permanent  address <span class="red-text">*</span></label>
                                                <input value="{{old('address2')}}" id="address2" name="address2" type="text" class="validate" required="" data-error=".errorAddress2">
                                                <small class="errorAddress2"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="fathername">Father Name</label>
                                                <input value="{{old('Fname')}}" id="fathername" name="Fname" type="text">
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="mothername">Mother Name</label>
                                                <input value="{{old('Mname')}}" id="mothername" name="Mname" type="text">
                                            </div>

                                            <div class="input-field file-field col m6 s12">
                                                <div class="btn float-right">
                                                  <span>Image: </span><span class="red-text">*</span>
                                                  <input name="image" type="file" accept="image/*">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input name="image" class="file-path validate" type="text" required="" data-error=".errorImage" accept="image/*">
                                                     <small style="display: none;" class="errorImage"></small>
                                                </div>
                                            </div>
                                        </div>

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

                                        <div class="row ">
                                            <div class="input-field col m6 s12">
                                                <select class="validate role" name="role" id="role" data-error=".errorTxt30" required="">
                                                <option value="" disabled selected>Select Role</option>
                                                <option {{ old('role') == 'admin' ? "selected" : "" }} value="admin">Admin</option>
                                                <option {{ old('role') == 'teacher' ? "selected" : "" }} value="teacher">Teacher</option>
                                                <option {{ old('role') == 'student' ? "selected" : "" }} value="student">Student</option>
                                                </select>
                                                <label>Role: <span class="red-text">*</span></label>
                                                <small class="errorTxt30"></small>
                                            </div>

                                            <div class="input-field col m6 s12 last">
                                                <select class="validate" name="status" id="status" data-error=".errorTxt35" required="">
                                                  <option  value="" disabled selected>Select Status</option>
                                                  <option {{ old('status') == 'active' ? "selected" : "" }} value="active">Active</option>
                                                  <option {{ old('status') == 'inactive' ? "selected" : "" }} value="inactive">Inactive</option>
                                                </select>
                                                <label>Status: <span class="red-text">*</span></label>
                                                <small class="errorTxt35"></small>
                                            </div>

                                        </div>

                                        <div class="row">
                                              <div class="input-field col m6 s12">
                                                <label for="password">Password <span class="red-text">*</span></label>
                                                <input id="password" type="password" name="password" data-error=".errorTxt3" required="">
                                                <small class="errorTxt3"></small>
                                            </div>

                                            <div class="input-field col m6 s12">
                                                <label for="cpassword">Confirm Password <span class="red-text">*</span></label>
                                                <input id="cpassword" type="password" name="cpassword" data-error=".errorTxt4" required="">
                                                <small class="errorTxt4"></small>
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

<!-- x-handlebars-template qualification-->
<script id="qualification-template" type="text/x-handlebars-template">
        <div class="qualificationaddRow" id="qualificationaddRow">
            <div id="qualification_delete_add_more_item" class="qualification_delete_add_more_item">
               

                    <div class="input-field col m5 s12">
                        <label for="institute_name">Institute Name
                            <span class="red-text"></span>
                        </label>
                        <input type="text" name="institute_name[]" id="institute_name" data-error=".errorinstitute_name">
                        <small class="errorinstitute_name"></small>
                    </div>

                    <div class="input-field col m3 s12">
                        <label for="subject">Subject Name
                            <span class="red-text"></span>
                        </label>

                        <input id="subject" type="text" name="subject[]" data-error=".errorsubject">
                        <small class="errorsubject"></small>
                    </div>

                    <div class="input-field col m2 s12">
                        <label for="qualification">Qualification/GPA
                            <span class="red-text"></span>
                        </label>
                        <input id="qualification" type="text" name="qualification[]" data-error=".errorqualification">
                        <small class="errorqualification"></small>
                    </div>

                    <div class="input-field col m2 s6">
                        <div id="institute_name_add" class="btn-light btn institute_name_add">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="red btn institute_nameremoveeventmore">
                            <i class="fas fa-minus-circle"></i>
                        </div>
                    </div>
               
            </div>
        </div>
 </script>
 <!-- x-handlebars-template qualification End-->


@endsection
