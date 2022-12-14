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



@endsection
