@extends('layouts.BackendLayout')

@section('content')
<?php
$sl= 1;
?>

<!-- gallary -->
    <link rel="stylesheet" media="screen" href="{{asset('Frontend/css/common.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('Frontend/css/reset.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="{{asset('Frontend/js/gallery.js')}}"></script>
    <script src="{{asset('Frontend/js/gallery.dev.js')}}"></script>


  <!-- gallary -->
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
                       Gallery Settings(Image Add) 
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

              <div class="col s12">
                <!-- gallery settings Add -->
                <div class="container">
                    <div class="row">
                        <form id="gallerysettings" class="col s12" action="@if(@isset($data)){{route('gallery.update',$data[0]->slug)}} @else{{route('gallery.store')}} @endif" method="POST" enctype="multipart/form-data">
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">Gallery Settings</h4>


                                        </div>
                                    <!-- warning msg show -->
                                    @if($errors->any())
                                       <div class="mt-5 card-alert card gradient-45deg-amber-amber">
                                        <div class="card-content white-text">
                                          <p>
                                            <i class="material-icons">warning</i> Opps! Something went wrong.</p>
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
                                                <i class="material-icons">warning</i> Opps!Something went wrong.</p>
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
                                                <label for="group_name">Group Name: <span class="red-text">*</span></label>
                                                <input value="@if(@isset($data)){{$data->group_name}}@else{{old('group_name')}}@endif" id="group_name" name="group_name" type="text" class="validate" data-error=".errorgroup_name" required="">
                                                <small class="errorgroup_name"></small>
                                            </div>

                                             <div class="input-field file-field col m6 s12">
                                                <div class="btn float-right">
                                                  <span>Image: </span><span class="red-text">*</span>
                                                  <input name="image[]" type="file" accept="image/*" multiple>
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input name="image[]" class="file-path validate" type="text" required="" data-error=".errorImage" accept="image/*" multiple>
                                                     <small style="display: none;" class="errorImage"></small>
                                                </div>
                                            </div>


                                        </div>

                                      
                                        <div class="row"
                                            <div class="col m4 s12 submit">
                                                <button id="submit" class="waves-effect waves-dark btn btn-primary btnSubmi" type="submit"> @if(@isset($data)) Update @else Submit @endif
                                                </button>
                                            </div>
                                        </div>
                              </div>
                          </div>
                        </form>
                    </div> 
                </div>
                <!-- gallery settings Add End-->
              </div>

            <!-- gallery settings show-->
              <!-- Responsive Table -->
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Gallery</h4>
                                <hr>
                            </div>
                          <div class="row">
                            <div class="col s12">
                            </div>
                            <div class="col s12">
                              <table class="responsive-table centered bordered">
                                <thead>
                                  <tr>
                                      <th data-field="sl">Sl</th>
                                      <th data-field="group_name">Group Name</th>
                                      <th data-field="image">Image</th>
                                      <th data-field="created_by">Created by</th>
                                      <th data-field="updated_by">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($gallery)==0)
                                        <td colspan="6">No Data Found</td>
                                    @else
                                        @foreach($gallery as $key)
                                         <?php 
                                           $prodID= Crypt::encrypt($key->slug);

                                            $count = App\Model\gallery::where('group_name',$key->group_name)->count();
                                         ?>
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td>{{$key->group_name}}</td>
                                              <td style="width:20%">
                                                <button type="button" class="btn btn-primary">
                                                    Total Image <span class="badge badge-light">{{$count}}</span>
                                                </button>
                                              </td>
                                         
                                              <td style="text-transform: capitalize;">
                                                @if($key->created_by==NULL)
                                                    N/A
                                                @else
                                                    @if($key->createduser==NULL)
                                                        <p style="color: red" >Wrong User</p>
                                                    @else
                                                        {{$key->createduser->first_name}} {{$key->createduser->last_name}}
                                                    @endif
                                                @endif
                                             </td>
                                              <td style="text-transform: capitalize;">
                                                @if($key->updated_by==NULL)
                                                    <span class="updated_by">N/A</span>
                                                @else
                                                    @if($key->updateuser==NULL)
                                                        <span class="updated_by" style="color: red" >Wrong User</span>
                                                    @else
                                                        <span class="updated_by">{{$key->updateuser->first_name}} {{$key->updateuser->last_name}}
                                                        </span>
                                                    @endif
                                                @endif
                                               
                                              </td>
                                              <td>
                                    

                                                 <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('gallery.view',$key->slug)}}" title="View"><i class="material-icons">remove_red_eye</i>/a>

                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('gallery.edit',$key->slug)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('gallery.delete',$key->slug) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
                                              </td>
                                           </tr>
                                        @endforeach
                                    @endif
                                  
                                
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- gallery settings show End-->

        </div>
    </div>
      <!-- END: Page Main-->
@endsection