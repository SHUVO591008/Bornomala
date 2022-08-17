@extends('layouts.BackendLayout')

@section('content')
<?php
use App\Model\generalsetting;
use App\Model\socialSettings;
use App\Model\HeaderTopPosition;

$sl = 1;
$s = 1;
$generalsetting = generalsetting::get();
$socialSettings = socialSettings::all();

$HeaderTopPosition = HeaderTopPosition::orderBy('sl','asc')->get();




?>

<style>
    .select-wrapper {
    display: none;
}

li.lwms-selectli{
    text-transform: capitalize;
}
</style>

 <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <link href="{{asset('Backend/app-assets/multiselect/jquery.lwMultiSelect.css')}}" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="{{asset('Backend/app-assets/multiselect/jquery.lwMultiSelect.js')}}"></script>


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
                        General Settings View
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


            <!-- general settings show-->
              <!-- Responsive Table -->
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">General Settings Show</h4>
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
                                      <th data-field="name">Name</th>
                                      <th data-field="icon">Icon</th>
                                      <th data-field="text">Text</th>
                                      <th data-field="status">Status</th>
                                      <th data-field="created">Created by</th>
                                      <th data-field="update">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($generalsetting)==0)
                                        <td colspan="8">No Data Found</td>
                                    @else
                                        @foreach($generalsetting as $key)
                                            <tr>
                                              <td>{{ $sl++ }}</td>
                                              <td style="text-transform: capitalize;">{{$key->name}}</td>
                                              <td><?php echo $key->icon?></td>
                                              <td>{{$key->text}}</td>
                                              <td>
                                                 @php $prodID= Crypt::encrypt($key->id); @endphp

                                                <div class="switch">
                                                    <label>
                                                      <span>Inactive</span>
                                                      <input {{(@$key->header_top_position==1)?'disabled':''}} data-column="{{route('general.status')}}" class="status general" data-id="{{$prodID}}" id="status'" {{($key->status==1)?'checked':''}} type="checkbox">
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
                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('general.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>

                                                 @if($key->header_top_position==0)
                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('general.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i></a>
                                                @endif
                                              </td>
                                           </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                              </table>

                                 <hr>
                              <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">General Position Customize
                              </h4>



                              <div class="row">
                             <!--  Left Position-->
                                  <div class="col md2 lg2">
                                      <h6 class="btn btn-success">
                                            Top Header Position (Left)
                                        </h1>
                                  </div>

                                  <div id="leftPosition" class="col  md4 lg4">
                                    <select id="defaults" multiple="multiple" name="position">
                                    

                                         @foreach(generalsetting::where('status',1)->whereNotIn('id',HeaderTopPosition::where('position','left')->pluck('gen_id'))->get() as $key)

                                                  <option value="{{Crypt::encrypt($key->id)}}">
                                                      {{$key->name}}
                                                  </option>
                                          @endforeach

                                           @foreach($HeaderTopPosition->where('position','left') as $key)
                                                  <option selected value="{{Crypt::encrypt($key->gen_id)}}">
                                                      {{$key->headerModelposition->name}}
                                                  </option>
                                          @endforeach
                                    </select>
                                  </div>

                                     <!--  Right Position-->
                                   <div class="col md2 lg2">
                                        <h6 class="btn btn-success">
                                              Top Header Position (Right)
                                          </h1>
                                    </div>

                                    <div id="rightPosition" class="col  md4 lg4">
                                      <select id="right" multiple="multiple" name="positionRight">
                                    

                                         @foreach(generalsetting::where('status',1)->whereNotIn('id',HeaderTopPosition::where('position','right')->pluck('gen_id'))->get() as $key)

                                                  <option value="{{Crypt::encrypt($key->id)}}">
                                                      {{$key->name}}
                                                  </option>
                                          @endforeach

                                           @foreach($HeaderTopPosition->where('position','right') as $key)
                                                  <option selected value="{{Crypt::encrypt($key->gen_id)}}">
                                                      {{$key->headerModelposition->name}}
                                                  </option>
                                          @endforeach

                                      </select>
                                    </div>

                                    <div style="border: 1px solid gray;" class="col s12 md12 lg12"></div>

                                      <!--  footer Position-->
                                   <div class="col md2 lg2">

                                        <h6 class="btn btn-success">
                                              Footer Position (Contact)
                                          </h1>
                                    </div>

                                    <div id="footerPosition" class="col  md4 lg4">
                                      <select id="footer" multiple="multiple" name="footerPosition">
                                          
                                    

                                         @foreach(generalsetting::where('status',1)->whereNotIn('id',HeaderTopPosition::where('position','footer')->pluck('gen_id'))->get() as $key)

                                                  <option value="{{Crypt::encrypt($key->id)}}">
                                                      {{$key->name}}
                                                  </option>
                                          @endforeach

                                           @foreach($HeaderTopPosition->where('position','footer') as $key)
                                                  <option selected value="{{Crypt::encrypt($key->gen_id)}}">
                                                      {{$key->headerModelposition->name}}
                                                  </option>
                                          @endforeach

                                      </select>
                                    </div>

                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- general settings show End-->


            <!-- Social settings show-->
              <!-- Responsive Table -->
              <div class="container">
                  <div class="row">
                    <div class="col s12 m12 l12">
                      <div id="responsive-table" class="card card card-default scrollspy">
                        <div class="card-content">
                           <div  class="card-header col m12 s12">
                                <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Social Media Settings Show</h4>
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
                                      <th data-field="name">Name</th>
                                      <th data-field="icon">Icon</th>
                                      <th data-field="text">Url</th>
                                      <th data-field="status">Status</th>
                                      <th data-field="status">Created by</th>
                                      <th data-field="status">Update by</th>
                                      <th data-field="action">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($socialSettings)==0)
                                        <td colspan="8">No Data Found</td>
                                    @else
                                        @foreach($socialSettings as $key)
                                            <tr>
                                              <td>{{ $s++ }}</td>
                                              <td style="text-transform: capitalize;">{{$key->name}}</td>
                                              <td><?php echo $key->icon?></td>
                                              <td>{{$key->url}}</td>
                                              <td>
                                                 @php $prodID= Crypt::encrypt($key->id); @endphp

                                                <div class="switch">
                                                    <label>
                                                      <span>Inactive</span>
                                                      <input {{(@$key->position_customize==1)?'disabled':''}} data-column="{{route('social.status')}}" class="status" data-id="{{$prodID}}" id="status" {{($key->status==1)?'checked':''}} type="checkbox">
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
                                                  <a class="btn-floating waves-effect waves-light amber darken-4 mr-5" href="{{route('social.edit',$prodID)}}" title="Edit"><i style="font-size: 14px;" class="fa-solid fa-pen-to-square"></i></a>

                                                @if($key->position_customize==0)
                                                  <a class="delete-confirm btn-floating waves-effect waves-light green darken-1" href="{{ route('social.delete',$prodID) }}" title="Delete"><i style="font-size: 14px;" class="fa-solid fa-trash-can"></i>
                                                  </a>
                                                @endif

                                              </td>
                                           </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                              </table>
                                <hr>
                              <h4 style="text-align: center;background: #d2ef5e;color: black;padding: 10px;    font-weight: 700;" class="General card-title ">Social Media Position Customize
                              </h4>

                              <div class="row1">
                                 <!--  Social Header Left Position-->
                                <div class="col md2 lg2">
                                  <h6 class="btn btn-success">
                                      Top Social Position (Left)
                                  </h6>
                                </div>

                                <div id="SocialleftPosition" class="col md4 lg4">
                                    <select id="socialleft" multiple="multiple" name="socailpositionleft">

                                       @foreach(socialSettings::where('status',1)->whereNotIn('id',HeaderTopPosition::where('position','socialleft')->pluck('gen_id'))->get() as $key)

                                                <option value="{{Crypt::encrypt($key->id)}}">
                                                    {{$key->name}}
                                                </option>
                                        @endforeach

                                         @foreach($HeaderTopPosition->where('position','socialleft') as $key)
                                                <option selected value="{{Crypt::encrypt($key->gen_id)}}">
                                                    {{$key->socialModelposition->name}}
                                                </option>
                                        @endforeach

                                    </select>
                                </div>

                                 <!--  Social Header Right Position-->
                                <div class="col md2 lg2">
                                  <h6 class="btn btn-success">
                                      Top Social Position (Right)
                                  </h6>
                                </div>

                                <div id="SocialrightPosition" class="col md4 lg4">
                                    <select id="socialright" multiple="multiple" name="socailpositionright">

                                       @foreach(socialSettings::where('status',1)->whereNotIn('id',HeaderTopPosition::where('position','socialright')->pluck('gen_id'))->get() as $key)

                                                <option value="{{Crypt::encrypt($key->id)}}">
                                                    {{$key->name}}
                                                </option>
                                        @endforeach

                                         @foreach($HeaderTopPosition->where('position','socialright') as $key)
                                                <option selected value="{{Crypt::encrypt($key->gen_id)}}">
                                                    {{$key->socialModelposition->name}}
                                                </option>
                                        @endforeach

                                    </select>
                                </div>

                                  <div style="border: 1px solid gray;" class="col s12 md12 lg12"></div>

                                 <!--  Social Footer Position-->
                                <div class="col md2 lg2">
                                  <h6 class="btn btn-success ">
                                      Social Footer Position    
                                  </h6>
                                </div>

                                <div id="SocialfooterPosition" class="col md4 lg4 ml-2">
                                    <select id="socialfooter" multiple="multiple" name="socailpositionfooter">

                                       @foreach(socialSettings::where('status',1)->whereNotIn('id',HeaderTopPosition::where('position','socialfooter')->pluck('gen_id'))->get() as $key)

                                                <option value="{{Crypt::encrypt($key->id)}}">
                                                    {{$key->name}}
                                                </option>
                                        @endforeach

                                         @foreach($HeaderTopPosition->where('position','socialfooter') as $key)
                                                <option selected value="{{Crypt::encrypt($key->gen_id)}}">
                                                    {{$key->socialModelposition->name}}
                                                </option>
                                        @endforeach

                                    </select>
                                </div>


                              </div>



                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- social settings show End-->


        </div>
    </div>
      <!-- END: Page Main-->

<script>
jQuery('#defaults').lwMultiSelect();
jQuery('#right').lwMultiSelect();
jQuery('#footer').lwMultiSelect();
jQuery('#socialleft').lwMultiSelect();
jQuery('#socialright').lwMultiSelect();
jQuery('#socialfooter').lwMultiSelect();
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>




@endsection
