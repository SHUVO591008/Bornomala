@extends('layouts.BackendLayout')

@section('content')

<?php
use App\Model\contact;
$sl = 1;
$contact = contact::latest()->get();
use Carbon\Carbon;


?>



 <style>
 	#main label select {
  display: inline-block;
  width: auto;
  height: auto;
}

#main label input {
  width: auto;
  height: auto;
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
                        Contact Message
                            </span>
                        </h5>
                    </div>

                    <div class="col s12 m6 l6 right-align-md">
                      <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">Contact Message Show
                        </li>
                      </ol>
                    </div>

                  </div>
                </div>
          </div>


      

            <!-- message settings show-->
              <!-- Responsive Table -->
 
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;font-size: 20px;font-weight: 700;" class="General card-title ">Contact Message
                               
                                </h4>


                                <div style="text-align:center;border-style: dashed;color: black;padding: 10px;font-weight: 700;font-size: 18px;" class="">

                                    
                                    <a  target="_blank" class="btn waves-effect waves-light blue accent-2" href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox">Go To Gmail Account</a>
                                </div>

                             
                               
                                <hr>
                            </div>
                          <div class="row">

                            <div class="col s12">

                          <table  id="page-length-option" class="centered bordered display">
                              <thead>
                                <tr>
                                    <th data-field="sl">Sl</th>
                                    <th data-field="name">Name</th>
                                    <th data-field="email">Email</th>
                                    <th data-field="mobile">Mobile</th>
                                    <th data-field="message">Message</th>
                                    <th data-field="time">Time</th>
                                    <th style="display:block!important" data-field="action">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @if(count($contact)==0)
                                      <td colspan="11">No Data Found</td>
                                  @else
                                      @foreach($contact as $key)
                                          @php $prodID= Crypt::encrypt($key->id); @endphp
                                          <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td style="text-transform:capitalize;">{{$key->name}}</td>
                                            <td  style="width:14%">{{$key->email}}</td>
                                            <td>{{$key->mobile}}</td>
                                            <td style="width:20%">
                                              <?php echo str_Limit(strip_tags($key->text),100)?>

                                              @if (strlen(strip_tags($key->text)) > 101)
                                                  <a href="{{ route('contact.view',$prodID) }}" class="waves-effect waves-light btn-small mb-1 mr-1 mt-3">Read More..</a>
                                              @endif
                                            </td>

                                            <td>{{Carbon::parse($key->created_at)->diffForHumans()}}</td>
                                            <td  style="width:15%">

                                               <a class="btn-floating waves-effect waves-light amber darken-3 mr-5" href="{{route('contact.view',$prodID)}}" title="View"><i style="font-size: 14px;" class="fa-solid fa-eye"></i></a>

                                                <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('contact.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                         </tr>
                                      @endforeach
                                  @endif
                              </tbody>
                               <tfoot>
                                         <tr >
                                    <th style="text-align:center;" data-field="sl">Sl</th>
                                    <th style="text-align:center;" data-field="name">Name</th>
                                    <th style="text-align:center;" data-field="email">Email</th>
                                    <th style="text-align:center;" data-field="mobile">Mobile</th>
                                    <th style="text-align:center;" data-field="message">Message</th>
                                    <th style="text-align:center;" data-field="time">Time</th>
                                    <th style="text-align:center;" data-field="action">Action</th>
                                </tr>
                                      </tfoot>
                              </table>

                            </div>

                          </div>




                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    
            <!-- message settings show End-->
        </div>
    </div>
      <!-- END: Page Main-->



@endsection