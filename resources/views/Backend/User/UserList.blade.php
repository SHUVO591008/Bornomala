@extends('layouts.BackendLayout')

@section('content')

<?php
use App\User;
$sl = 1;
$users = User::latest()->get();
use Carbon\Carbon;
?>

<style>
  .avatar {
  background-color: #aaa;
  border-radius: 50%;
  color: #fff;
  display: inline-block;
  font-weight: 500;
  height: 38px;
  line-height: 38px;
  margin: 0 10px 0 0;
    margin-right: 10px;
  text-align: center;
  text-decoration: none;
  text-transform: uppercase;
  vertical-align: middle;
  width: 38px;
  position: relative;
  white-space: nowrap;
}

.avatar > img {
  border-radius: 50%;
  display: block;
  overflow: hidden;
  width: 100%;
}

table.table td h2.table-avatar {
  align-items: center;
  display: inline-flex;
  font-size: inherit;
  font-weight: 400;
  margin: 0;
  padding: 0;
  vertical-align: middle;
  white-space: nowrap;
}

table.table td h2 span {
  color: #888;
  display: block;
  font-size: 12px;
  margin-top: 3px;
}

</style>
  <!-- BEGIN: Page Main-->
  <div id="main">
    <div class="row">
      <div id="breadcrumbs-wrapper" data-image="{{ asset("Backend/app-assets/images/gallery/breadcrumb-bg.jpg") }}">
        <!-- Search for small screen-->
        <div class="container">
          <div class="row">
            <div class="col s12 m6 l6">
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>Users List</span></h5>
            </div>
            <div class="col s12 m6 l6 right-align-md">
              <ol class="breadcrumbs mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('users.list') }}">User</a>
                </li>
                <li class="breadcrumb-item active">Users List
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="col s12">
        <div class="container">
<!-- users list start -->
<section class="users-list-wrapper section">

    <div class="users-list-filter">
    <div class="card-panel">
        <div class="row">
        <form>
            <div class="col s12 m6 l3">
            <label for="users-list-verified">Verified</label>
            <div class="input-field">
                <select class="form-control" id="users-list-verified">
                <option value="">Any</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                </select>
            </div>
            </div>
            <div class="col s12 m6 l3">
            <label for="users-list-role">Role</label>
            <div class="input-field">
                <select class="form-control" id="users-list-role">
                <option value="">Any</option>
                <option value="User">User</option>
                <option value="Staff">Staff</option>
                </select>
            </div>
            </div>
            <div class="col s12 m6 l3">
            <label for="users-list-status">Status</label>
            <div class="input-field">
                <select class="form-control" id="users-list-status">
                <option value="">Any</option>
                <option value="Active">Active</option>
                <option value="Close">Close</option>
                <option value="Banned">Banned</option>
                </select>
            </div>
            </div>
            <div class="col s12 m6 l3 display-flex align-items-center show-btn">
            <button type="submit" class="btn btn-block indigo waves-effect waves-light">Show</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <div class="users-list-table">
    <div class="card">
        <div class="card-content">
        <!-- datatable start -->
        <div class="responsive-table">
            <table id="users-list-datatable" class="table responsive-table bordered centered">
            <thead>
                <tr>

                <th>SL</th>
                <th>User Name </th>
                <th>Name</th>
                <th>Email/Phone</th>
                <th>Last activity</th>
                <th>Online Check</th>
                <th>Verified</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>

                </tr>
            </thead>
            <tbody>

                @foreach($users as $key)
                @php $UserID= Crypt::encrypt($key->id); @endphp
                <tr>

                <td>{{ $sl++ }}</td>

                <td style="text-align: left;">
                    <h2 class="table-avatar">
                    <a class="avatar" href="page-users-view.html">
                    <img class="" src="{{asset($key->image)}}">

                    </a>
                    <a href="">
                    {{$key->user_name}}
                    <span>{{$key->student_id}}</span>
                    </a>

                    </h2>
                </td>
                <td style="text-transform: uppercase;">{{$key->first_name}} {{$key->last_name}}</td>
                <td>
                    {{$key->email}}
                    <span style="display:block">{{$key->mobile}}</span>
                </td>
                <td>


                    @if(Cache::has('user-is-online-' . $key->id))

                        <span class="text-success">{{Carbon::parse($key->last_login)->diffForHumans()}}</span>
                    @else

                    @if($key->last_login==NULL)
                        <span class="text-secondary">NULL</span>
                    @else
                        <span class="text-success">{{Carbon::parse($key->last_login)->diffForHumans()}}</span>
                    @endif


                    @endif

                </td>
                <td>
                    @if(Cache::has('user-is-online-' . $key->id))

                        <span class="text-success">Online</span>
                    @else
                        <span class="text-secondary">Offline</span>
                    @endif
                </td>
                <td>

                    @if($key->email_verified_at==NULL)
                    No
                    @else
                    Yes
                    @endif
                </td>
                <td style="text-transform: uppercase;">{{$key->role}}</td>
                <td style="text-transform: uppercase;">
                    <div class="switch">
                        <label>
                        <span>Inactive</span>
                        <input data-column="{{route('slider.status')}}" class="status" data-id="{{$UserID}}" id="status" {{($key->status=="active")?'checked':''}} type="checkbox">
                        <span class="lever"></span>
                        <span>Active</span>
                        </label>
                    </div>
                </td>
                <td>
                    <a title="Edit" style="margin-right: 10px;" href="page-users-edit.html"><i class="material-icons">edit</i></a>

                    <a style="margin-right: 10px;" title="View" href="{{route('users.view',$UserID)}}"><i class="material-icons">remove_red_eye</i></a>

                    <a style="margin-right: 10px;" class="" title="Email" href="page-users-view.html"><i style="font-size: 19px;" class=" fa-solid fa-envelope-open-text"></i></a>

                    @if(!$key->mobile==null)
                    <a style="margin-right: 10px;" class="" title="SMS" href="page-users-view.html"><i style="font-size: 19px;" class="fa-solid fa-comment-sms"></i></a>
                    @endif



                    <a class="material-icons delete-confirm" href="{{ route('news.delete',$UserID) }}" title="Delete"><i style="font-size: 19px;" class="fa-solid fa-trash-can"></i></a>

                </td>

                </tr>
            @endforeach

            </tbody>
            </table>
        </div>
        <!-- datatable ends -->

        </div>
    </div>
    </div>
</section>
<!-- users list ends -->



  <!-- END: Page Main-->


@endsection
