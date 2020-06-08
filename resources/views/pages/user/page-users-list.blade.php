{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users list')

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('public/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users list start -->
<section class="users-list-wrapper section">
  <div class="users-list-filter">
    <div class="card-panel">
      <div class="row">
        <form>
          <div class="col s12 m6 l2">
            <label for="users-list-verified">Verified</label>
            <div class="input-field">
              <select class="form-control" id="users-list-verified">
                <option value="">Any</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
          <div class="col s12 m6 l2">
            <label for="users-list-role">Role</label>
            <div class="input-field">
              <select class="form-control" id="users-list-role">
                <option value="">Any</option>
                <option value="User">User</option>
                <option value="Staff">Staff</option>
              </select>
            </div>
          </div>
          <div class="col s12 m6 l2">
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
          <div class="col s12 m6 l3 display-flex align-items-center show-btn">
            <a href="{{ route('add.user') }}" class="btn btn-block indigo waves-effect waves-light">Add User</a>
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
          <table id="users-list-datatable" class="table">
            <thead>
              <tr>
                <th></th>
                <th>id</th>
                <th>username</th>
                <th>name</th>
                <th>role</th>
                <th>status</th>
                <th>edit</th>
                <th>view</th>
                <th>delete / restore</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr {{ isset($user->deleted_at) ? 'style=text-decoration:line-through;':'' }}>
                <td></td>
                <td>{{ $user->id }}</td>
                <td><a href="{{route('view.user', $user)}}">{{$user->username}}</a>
                </td>
                <td>{{ $user->first_name . ' ' . $user->last_name}}</td>
                <td>{{ strtoupper($user->user_type) }}</td>
                <td>
                  @if ($user->status == 1)
                  <span class="chip green lighten-5">
                    <span class="green-text">Active</span>
                  </span>
                  @else
                  <span class="chip red lighten-5"><span class="red-text">Banned</span></span>
                  @endif
                </td>
                @if (isset($user->deleted_at))
                <td></td>
                <td></td>
                <td><a href="{{route('restore.user', $user)}}"><i class="material-icons">restore</i></a></td>
                @else
                <td><a href="{{route('edit.user', $user)}}"><i class="material-icons">edit</i></a></td>
                <td><a href="{{route('view.user', $user)}}"><i class="material-icons">remove_red_eye</i></a></td>
                <td><a href="{{route('delete.user', $user)}}"><i class="material-icons">delete</i></a></td>
                @endif
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
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('public/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('public/js/scripts/page-users.js')}}"></script>
@endsection