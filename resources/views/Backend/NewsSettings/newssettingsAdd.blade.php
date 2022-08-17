@extends('layouts.BackendLayout')

@section('content')
<?php
use App\Model\news;
use App\Model\newsScrollBar;
$sl = 1;
$news = news::all();
$newsScrollBar = newsScrollBar::first();

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
                        News Scroll Settings @if(@isset($data)) Edit @else Add @endif
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">News Add/Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>

              <div class="col s12">
                
                <!-- news settings Add -->
                <div class="container">
                    <div class="row">
                        <form id="newssettings" class="col s12" action="@if(@isset($data)){{route('news.update',Crypt::encrypt($data->id))}} @else{{route('news.store')}} @endif" method="POST"  >
                             @csrf
                             <div class="card">
                                    <div class="card-content">
                                        <div  class="card-header col m12 s12">
                                            <h4 style="float: left;" class="General card-title">News Settings</h4>

                                        
                                            @if(@isset($data))
                                                 <a class="btn right mr-3" href="{{route('news.add')}}">Add</a>
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
                                             
                                            <div class="input-field col m12 s12">
                                                <label for="title">Text: <span class="red-text">*</span></label>
                                                <input value="@if(@isset($data)){{$data->title}}@else{{old('title')}}@endif" id="title" name="title" type="text" class="validate" data-error=".errortitle" required="">
                                                <small class="errortitle"></small>
                                            </div>


                                             <div class="input-field col m8 s12">
                                                <label for="url">Url: <span class="red-text"></span></label>
                                                <input value="@if(@isset($data)){{$data->url}}@else{{old('url')}}@endif" id="url" name="url" type="url" class="validate" data-error=".errorurl">
                                                <small class="errorurl"></small>
                                            </div>

                                          

                                           
                                
                                             <div class="input-field col m4 s12">
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
                <!-- news settings Add End-->
              </div>

            <!-- news scroll settings show-->
              <!-- Responsive Table -->
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">News Scroll Settings Show
                               
                                </h4>
                                <div style="text-align:center;border-style: dashed;color: black;padding: 10px;font-weight: 700;font-size: 18px;" class=""><p>News Scroll Bar Show Or Hide</p>
                                    <div class="switch">
                                        <label>
                                          <span style="font-size:16px;font-weight: 700;color: black;">Hide</span>
                                          <input data-column="{{route('news.scrollBar')}}" class="showOrhide" data-id="{{(@$newsScrollBar->id)? Crypt::encrypt($newsScrollBar->id):'N/A'}}" id="showOrhide" {{(@$newsScrollBar->status==1)?'checked':''}} type="checkbox">
                                          <span class="lever"></span>
                                          <span style="font-size:16px;font-weight: 700;color: black;">Show</span> 
                                        </label>
                                    </div>

                                </div>
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
                                      <th data-field="text">Text</th>
                                      <th data-field="status">Status</th>
                                      <th data-field="created_by">Created by</th>
                                      <th data-field="updated_by">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($news)==0)
                                        <td colspan="6">No Data Found</td>
                                    @else
                                        @foreach($news as $key)
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td style="width:20%">{{$key->title}}</td>
                                            
                                        
                                              <td>
                                                 @php $prodID= Crypt::encrypt($key->id); @endphp

                                                <div class="switch">
                                                    <label>
                                                      <span>Inactive</span>
                                                      <input data-column="{{route('news.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
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
                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('news.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>
                                                  

                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('news.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
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