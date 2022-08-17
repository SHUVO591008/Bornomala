@extends('layouts.BackendLayout')

@section('content')
<?php
use App\Model\header;

$sl = 1;
$header = header::all();


?>
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
                        Header Settings @if(@isset($data)) Edit @else Add @endif
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
                
                <!-- header settings Add -->
                <div class="container">
                    <div class="row">
                        <form id="headersettings" class="col s12" action="@if(@isset($data)){{route('header.update',Crypt::encrypt($data->id))}} @else{{route('header.store')}} @endif" method="POST"  >
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">Header Settings</h4>

                                            <a class="right fontawesome btn waves-effect waves-light amber darken-4" target="_blank" href="https://fontawesome.com/icons">Font Awesome Link</a>

                                            @if(@isset($data))
                                                 <a class="btn right mr-3" href="{{route('header.add')}}">Add</a>
                                             @endif
                                           

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
                                             <div class="input-field col m5 s12">
                                                <label for="title">Title: <span class="red-text">*</span></label>
                                                <input value="@if(@isset($data)){{$data->title}}@else{{old('title')}}@endif" id="title" name="title" type="text" class="validate" data-error=".errortitle" required="">
                                                <small class="errortitle"></small>
                                            </div>

                                             <div class="input-field col m4 s12">
                                                <label for="icon">Icon: <span class="red-text">*</span></label>
                                                <input value="@if(@isset($data)){{$data->icon}}@else{{old('icon')}}@endif" id="icon" name="icon" type="text" class="validate" data-error=".erroricon" required="">
                                                <small class="erroricon"></small>
                                            </div>

                                            <div class="input-field col m3 s12">
                                                <label for="name">Author Name: <span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->author_name}}@else{{old('author_name')}}@endif" id="author_name" name="author_name" type="text" class="validate" data-error=".errorauthorname">
                                                <small class="errorauthorname"></small>
                                            </div>

                                           

                                            <div class="input-field col m9 s12">
                                                <label for="text">Text: <span class="red-text">*</span></label>
                                                <input value="@if(@isset($data)){{$data->text}}@else{{old('text')}}@endif" id="text" name="text" type="text" class="validate" data-error=".errortext" required="">
                                                <small class="errortext"></small>
                                            </div>
                                
                                             <div class="input-field col m3 s12">
                                                <select class="validate" name="status" id="status" data-error=".errorStatus" required="">

                                                <option value="" selected>Select Status</option>
                                                <option @if(@isset($data)) {{($data->status==1)?'selected':''}} @else {{ old('status') == 'active' ? "selected" : "" }} @endif  value="active">Active</option>
                                                
                                                <option @if(@isset($data)) {{($data->status==0)?'selected':''}} @else {{ old('status') == 'inactive' ? "selected" : "" }} @endif  value="inactive">Inactive</option>
                                              
                                                </select>
                                                <label>Status: <span class="red-text">*</span></label>
                                                <small class="errorStatus"></small>
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
                <!-- header settings Add End-->
              </div>

            <!-- header settings show-->
              <!-- Responsive Table -->
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Header Settings Show</h4>
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
                                      <th data-field="title">Title</th>
                                      <th data-field="text">Text</th>
                                      <th data-field="icon">Icon</th>
                                      <th data-field="author_name">Author Name</th>
                                      <th data-field="status">Status</th>
                                      <th data-field="created_by">Created by</th>
                                      <th data-field="updated_by">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($header)==0)
                                        <td colspan="9">No Data Found</td>
                                    @else
                                        @foreach($header as $key)
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td>{{$key->title}}</td>
                                              <td style="width:20%">{{$key->text}}</td>
                                              <td><?php echo $key->icon?></td>
                                              <td>
                                                @if($key->author_name==NULL)
                                                    N/A
                                                @else
                                                   {{$key->author_name}}
                                                @endif
                                                
                                              </td>
                                              <td>
                                                 @php $prodID= Crypt::encrypt($key->id); @endphp

                                                <div class="switch">
                                                    <label>
                                                      <span>Inactive</span>
                                                      <input data-column="{{route('header.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
                                                      <span class="lever"></span>
                                                      <span>Active</span> 
                                                    </label>
                                                </div>
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
                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('header.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('header.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
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
            <!-- header settings show End-->
        </div>
    </div>
      <!-- END: Page Main-->
@endsection