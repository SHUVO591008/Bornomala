@extends('layouts.BackendLayout')

@section('content')
  
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div id="breadcrumbs-wrapper" data-image="{{asset('Backend/app-assets/images/gallery/breadcrumb-bg.jpg')}}">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s12 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span> View</span></h5>
              </div>
              <div class="col s12 m6 l6 right-align-md">
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="{{ route('all.admission') }}">Admission List</a>
                  </li>
                  <li class="breadcrumb-item active">Student View
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
        <div class="container">
      <!-- users view start -->
<div class="section users-view">
  <!-- users view media object start -->
  <div class="card-panel">
    <div class="row">
      <div class="col s12 m7">
        <div class="display-flex media">
          <a href="#" class="avatar">
        
            <img src="{{asset($data->student_image)}}" alt="Student view avatar" class="z-depth-4 circle" height="64" width="64">
          </a>
          <div class="media-body">
            <h6 class="media-heading">
              <span class="">{{$data->first_name}} {{$data->last_name}}</span>
              <span class="grey-text">@</span>
              <span class=" grey-text">{{$data->user_name}}</span>
            </h6>
            <span>ID:</span>
            <span class="">{{$data->student_id}}</span>
          </div>
        </div>
      </div>

      @php $UserID= Crypt::encrypt($data->id); @endphp

      <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
        <a href="app-email.html" class="btn-small btn-light-indigo"><i class="material-icons">mail_outline</i></a>
        <a href="user-profile-page.html" class="btn-small btn-light-indigo">Print</a>
        <a href="{{route('admission.edit',$UserID)}}" class="btn-small indigo">Edit</a>
      </div>
    </div>
  </div>
  <!-- users view media object ends -->


  <!-- users view card details start -->
  <div class="card">

    <div class="card-content">
     
      <div class="row">
        <div class="col s12">
     

          <div class="row mt-3">
            <div class="col s12 l6 m6">
              <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Student Information</h6>
              <hr>

              <div class="col md-12 m12 l12 s12">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <a href="#" class="avatar ">
                      <img style="position:relative;left:50%;padding:5px;box-shadow:0px 0px 10px 0px black" src="{{asset($data->student_image)}}" alt="Student view avatar" class="z-depth-4 circle mt-3" height="113" width="113">
                      </a>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>User Name:</th>
                      <td style="text-align: right">{{$data->user_name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>User ID:</th>
                      <td style="text-align: right">{{$data->student_id}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Name :</th>
                      <td style="text-transform: capitalize;text-align: right;">{{$data->first_name}} {{$data->last_name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Email :</th>
                      <td  style="text-align: right" class="users-view-email">{{$data->email}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>



              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Birthday:</th>
                      <td  style="text-align: right">{{ date('d/m/Y', strtotime($data->dob)) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Age:</th>
                      <td  style="text-align: right">{{ \Carbon\Carbon::parse($data->dob)->age }} Years</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Country:</th>
                      <td style="text-transform: capitalize;text-align: right">{{$data->country}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Contact:</th>
                      <td style="text-align: right">{{$data->mobile}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Gender:</th>
                      <td style="text-transform: capitalize;text-align: right">{{$data->gender}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Religion:</th>
                      <td style="text-transform: capitalize;text-align: right">{{$data->religion}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Blood Group:</th>
                      <td style="text-transform: capitalize;text-align: right">{{$data->blood_group}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>




              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Admission Date:</th>
                      <td style="text-align: right">{{\Carbon\Carbon::parse($data->admission_date)->format('d-m-Y')}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Admission Fee:</th>
                      <td style="text-align: right">{{$data->admission_fee}} Tk</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Discount:</th>
                      <td style="text-align: right">  {{($data->discount==null)?'0':$data->discount}} %</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Student Type:</th>
                      <td style="text-align: right">{{$data->scholarship}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>



              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Admission Class:</th>
                      <td style="text-align: right">{{$data->class}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Section:</th>
                      <td style="text-align: right">{{$data->section}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Year:</th>
                      <td style="text-align: right"> {{$data->year}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

          

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Status:</th>
                      <td style="text-transform: capitalize;text-align: right">
                        <span class=" chip green lighten-5 green-text">
                          {{$data->status}}
                        </span></td>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Last Activity:</th>
                      <td style="text-transform: capitalize;text-align: right">
                        <td style="text-align: right">
                          @if ($data->last_login==null)
                            <span class="chip green lighten-5 red-text">Not logged in yet.</span>
                          @else
                            <span >{{\Carbon\Carbon::parse($data->last_login)->format('d-m-Y')}}</span>
                          @endif
                        </td>
                    </tr>
                  </tbody>
                </table>
              </div>




            </div>

            <div class="col s12 l6 m6">
              <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Other Information</h6>
              <hr>

              <div class="col md-12 m12 l12 s12">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <a href="#" class="avatar">
                      <img style="position:relative;left:50%;padding:5px;box-shadow:0px 0px 10px 0px black" src="{{asset($data->gurdian_image)}}" alt="Gurdian view avatar" class="z-depth-4 circle mt-3" height="113" width="113">
                      </a>
                    </tr>
                  </tbody>
                </table>
              </div>
           


              <div class="col md-12 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Gurdian Number:</th>
                      <td style="text-align: right">{{$data->gurdian_mobile}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-6 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Gurdian NID:</th>
                      <td style="text-align: right">{{$data->nid_number}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

             

              <div class="col md-6 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                  <tr>
                    <th>Father Name:</th>
                    <td style="text-align: right">{{$data->father_name}}</td>
                  </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-6 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                  <tr>
                    <th>Occupation:</th>
                    <td style="text-align: right">{{$data->father_occupation}}</td>
                  </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-6 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                  <tr>
                    <th>Mother Name:</th>
                    <td style="text-align: right">{{$data->mother_name}}</td>
                  </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-6 m6 l6">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Occupation:</th>
                      <td style="text-align: right">{{$data->mother_occupation}}</td>
                    </tr>
                  </tbody>
               </table>
              </div>

              <div class="col md-12 m6 l12">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Present Address:</th>
                      <td style="text-align: right">{{$data->present_address}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col md-12 m6 l12">
                <table class=" responsive-table">
                  <tbody>
                    <tr>
                      <th>Permanent Address: </th>
                      <td style="text-align: right">{{$data->permanent_address}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>


          </div>

         
          @if (!count($social)==0)
            
          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
          @foreach($social as $key)
            <div class="col md-12 m6 l12">
              <table class=" responsive-table">
                <tbody>
                  <tr>
                    <th style="text-transform: capitalize;">{{$key->socialicon}}: </th>
                    <td><a target="_blank" href="{{$key->socialUrl}}">{{$key->socialUrl}}/</a></td>
                  </tr>
                </tbody>
              </table>
            </div>

          @endforeach
            
          @endif

        
   


   
          <h6 style="margin-top: 177px;" class="mb-2"><i class="fa-solid fa-book mr-1"></i> Education</h6>
            <div class="col md-12 m6 l6">
              <table class=" responsive-table">
                <tbody>
                  <tr>
                    <th>School/Collage Name:</th>
                    <td style="text-align: right">{{$data->school_collage}}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="col md-12 m6 l6">
              <table class=" responsive-table">
                <tbody>
                  <tr>
                    <th>Class:</th>
                    <td style="text-align: right">{{$data->school_collage_class}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
     

         


        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <!-- users view card details ends -->

 
  @if (!$data->about==null)
    
    <div class="card-panel">
      <h6>Messege</h6>
      <hr>
      <p>
        {{$data->about}}
      </p>

    </div>
    
  @endif



    </div>

</div>
<!-- users view ends --><!-- START RIGHT SIDEBAR NAV -->
<aside id="right-sidebar-nav">
  <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
    <div class="row">
      <div class="slide-out-right-title">
        <div class="col s12 border-bottom-1 pb-0 pt-1">
          <div class="row">
            <div class="col s2 pr-0 center">
              <i class="material-icons vertical-text-middle"><a href="#" class="sidenav-close">clear</a></i>
            </div>
            <div class="col s10 pl-0">
              <ul class="tabs">
                <li class="tab col s4 p-0">
                  <a href="#messages" class="active">
                    <span>Messages</span>
                  </a>
                </li>
                <li class="tab col s4 p-0">
                  <a href="#settings">
                    <span>Settings</span>
                  </a>
                </li>
                <li class="tab col s4 p-0">
                  <a href="#activity">
                    <span>Activity</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="slide-out-right-body row pl-3">
        <div id="messages" class="col s12 pb-0">
          <div class="collection border-none mb-0">
            <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages">
            <ul class="collection right-sidebar-chat p-0 mb-0">
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Elizabeth Elliott</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                </div>
                <span class="secondary-content medium-small">5.00 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-1.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Mary Adams</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                </div>
                <span class="secondary-content medium-small">4.14 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-2.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Caleb Richards</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Hello Boo</p>
                </div>
                <span class="secondary-content medium-small">4.14 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-3.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Caleb Richards</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Keny !</p>
                </div>
                <span class="secondary-content medium-small">9.00 PM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-4.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">June Lane</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Ohh God</p>
                </div>
                <span class="secondary-content medium-small">4.14 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-5.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Edward Fletcher</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Love you</p>
                </div>
                <span class="secondary-content medium-small">5.15 PM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-6.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Crystal Bates</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can we</p>
                </div>
                <span class="secondary-content medium-small">8.00 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Nathan Watts</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Great!</p>
                </div>
                <span class="secondary-content medium-small">9.53 PM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-8.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Willard Wood</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Do it</p>
                </div>
                <span class="secondary-content medium-small">4.20 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-1.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Ronnie Ellis</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Got that</p>
                </div>
                <span class="secondary-content medium-small">5.20 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-9.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Daniel Russell</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Thank you</p>
                </div>
                <span class="secondary-content medium-small">12.00 AM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-10.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Sarah Graves</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Okay you</p>
                </div>
                <span class="secondary-content medium-small">11.14 PM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-off avatar-50"><img src="../../../app-assets/images/avatar/avatar-11.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Andrew Hoffman</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Can do</p>
                </div>
                <span class="secondary-content medium-small">7.30 PM</span>
              </li>
              <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
                <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-12.png" alt="avatar">
                  <i></i>
                </span>
                <div class="user-content">
                  <h6 class="line-height-0">Camila Lynch</h6>
                  <p class="medium-small blue-grey-text text-lighten-3 pt-3">Leave it</p>
                </div>
                <span class="secondary-content medium-small">2.00 PM</span>
              </li>
            </ul>
          </div>
        </div>
        <div id="settings" class="col s12">
          <p class="setting-header mt-8 mb-3 ml-5 font-weight-900">GENERAL SETTINGS</p>
          <ul class="collection border-none">
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Notifications</span>
                <div class="switch right">
                  <label>
                    <input checked="" type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Show recent activity</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Show recent activity</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Show Task statistics</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Show your emails</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Email Notifications</span>
                <div class="switch right">
                  <label>
                    <input checked="" type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
          </ul>
          <p class="setting-header mt-7 mb-3 ml-5 font-weight-900">SYSTEM SETTINGS</p>
          <ul class="collection border-none">
            <li class="collection-item border-none">
              <div class="m-0">
                <span>System Logs</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Error Reporting</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Applications Logs</span>
                <div class="switch right">
                  <label>
                    <input checked="" type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Backup Servers</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
            <li class="collection-item border-none">
              <div class="m-0">
                <span>Audit Logs</span>
                <div class="switch right">
                  <label>
                    <input type="checkbox">
                    <span class="lever"></span>
                  </label>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div id="activity" class="col s12">
          <div class="activity">
            <p class="mt-5 mb-0 ml-5 font-weight-900">SYSTEM LOGS</p>
            <ul class="widget-timeline mb-0">
              <li class="timeline-items timeline-icon-green active">
                <div class="timeline-time">Today</div>
                <h6 class="timeline-title">Homepage mockup design</h6>
                <p class="timeline-text">Melissa liked your activity.</p>
                <div class="timeline-content orange-text">Important</div>
              </li>
              <li class="timeline-items timeline-icon-cyan active">
                <div class="timeline-time">10 min</div>
                <h6 class="timeline-title">Melissa liked your activity Drinks.</h6>
                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                <div class="timeline-content green-text">Resolved</div>
              </li>
              <li class="timeline-items timeline-icon-red active">
                <div class="timeline-time">30 mins</div>
                <h6 class="timeline-title">12 new users registered</h6>
                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                <div class="timeline-content">
                  <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Registration.doc
                </div>
              </li>
              <li class="timeline-items timeline-icon-indigo active">
                <div class="timeline-time">2 Hrs</div>
                <h6 class="timeline-title">Tina is attending your activity</h6>
                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                <div class="timeline-content">
                  <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Activity.doc
                </div>
              </li>
              <li class="timeline-items timeline-icon-orange">
                <div class="timeline-time">5 hrs</div>
                <h6 class="timeline-title">Josh is now following you</h6>
                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                <div class="timeline-content red-text">Pending</div>
              </li>
            </ul>
            <p class="mt-5 mb-0 ml-5 font-weight-900">APPLICATIONS LOGS</p>
            <ul class="widget-timeline mb-0">
              <li class="timeline-items timeline-icon-green active">
                <div class="timeline-time">Just now</div>
                <h6 class="timeline-title">New order received urgent</h6>
                <p class="timeline-text">Melissa liked your activity.</p>
                <div class="timeline-content orange-text">Important</div>
              </li>
              <li class="timeline-items timeline-icon-cyan active">
                <div class="timeline-time">05 min</div>
                <h6 class="timeline-title">System shutdown.</h6>
                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                <div class="timeline-content blue-text">Urgent</div>
              </li>
              <li class="timeline-items timeline-icon-red">
                <div class="timeline-time">20 mins</div>
                <h6 class="timeline-title">Database overloaded 89%</h6>
                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                <div class="timeline-content">
                  <img src="../../../app-assets/images/icon/pdf.png" alt="document" height="30" width="25" class="mr-1">Database-log.doc
                </div>
              </li>
            </ul>
            <p class="mt-5 mb-0 ml-5 font-weight-900">SERVER LOGS</p>
            <ul class="widget-timeline mb-0">
              <li class="timeline-items timeline-icon-green active">
                <div class="timeline-time">10 min</div>
                <h6 class="timeline-title">System error</h6>
                <p class="timeline-text">Melissa liked your activity.</p>
                <div class="timeline-content red-text">Error</div>
              </li>
              <li class="timeline-items timeline-icon-cyan">
                <div class="timeline-time">1 min</div>
                <h6 class="timeline-title">Production server down.</h6>
                <p class="timeline-text">Here are some news feed interactions concepts.</p>
                <div class="timeline-content blue-text">Urgent</div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Slide Out Chat -->
  <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
    <li class="center-align pt-2 pb-2 sidenav-close chat-head">
      <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
    </li>
    <li class="chat-body">
      <ul class="collection">
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">hello!</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">How can we help? We're here for you!</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">I am looking for the best admin template.?</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>
          </div>
        </li>

        <li class="collection-item display-grid width-100 center-align">
          <p>8:20 a.m.</p>
        </li>

        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">Ohh! very nice</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Thank you.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">How can I purchase it?</p>
          </div>
        </li>

        <li class="collection-item display-grid width-100 center-align">
          <p>9:00 a.m.</p>
        </li>

        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">From ThemeForest.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Only $24</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">Ohh! Thank you.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="../../../app-assets/images/avatar/avatar-7.png" alt="avatar">
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">I will purchase it for sure.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Great, Feel free to get in touch on</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">https://pixinvent.ticksy.com/</p>
          </div>
        </li>
      </ul>
    </li>
    <li class="center-align chat-footer">
      <form class="col s12" onsubmit="slideOutChat()" action="javascript:void(0);">
        <div class="input-field">
          <input id="icon_prefix" type="text" class="search">
          <label for="icon_prefix">Type here..</label>
          <a onclick="slideOutChat()"><i class="material-icons prefix">send</i></a>
        </div>
      </form>
    </li>
  </ul>
</aside>
<!-- END RIGHT SIDEBAR NAV -->
<div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a>
    <ul>
        <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
        <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
        <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
        <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
    </ul>
</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection
