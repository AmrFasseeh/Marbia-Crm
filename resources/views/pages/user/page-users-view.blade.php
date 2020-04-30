{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users View')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/css/pages/page-users.css')}}">
@endsection

{{-- page content  --}}
@section('content')
<!-- users view start -->
<div class="section users-view">
  <!-- users view media object start -->
  <div class="card-panel">
    <div class="row">
      <div class="col s12 m7">
        <div class="display-flex media">
          <a href="#" class="avatar">
            <img src="{{ $user->image ? $user->image->url():asset('marbia/marbia-crm/public/images/avatar/default.png') }}" alt="users view avatar" class="z-depth-4 circle"
              height="64" width="64">
          </a>
          <div class="media-body">
            <h6 class="media-heading">
              <span class="users-view-name">{{ $user->first_name .' '. $user->last_name }}</span>
              <span class="grey-text">@</span>
              <span class="users-view-username grey-text">{{ $user->username }}</span>
            </h6>
            <span>ID:</span>
            <span class="users-view-id">{{ $user->id }}</span>
          </div>
        </div>
      </div>
      <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
        <a href="{{asset('app-email')}}" class="btn-small btn-light-indigo"><i
            class="material-icons">mail_outline</i></a>
        <a href="{{ route('edit.user', $user->id) }}" class="btn-small indigo">Edit</a>
      </div>
    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s12 m6">
          <table class="striped">
            <tbody>
              <tr>
                <td>Registered:</td>
                <td>{{ $user->created_at }}</td>
              </tr>
              <tr>
                <td>Latest Activity:</td>
                <td class="users-view-latest-activity">{{ $user->updated_at }}</td>
              </tr>
              <tr>
                <td>Verified:</td>
                <td class="users-view-verified">Yes</td>
              </tr>
              <tr>
                <td>Role:</td>
                <td class="users-view-role">{{ $user->user_type }}</td>
              </tr>
              <tr>
                <td>Status:</td>
                @if ($user->status == 1)
                <td><span class="users-view-status chip green lighten-5 green-text">Active</span></td>
                @else
                <td><span class="users-view-status chip red lighten-5"><span class="red-text">Banned</span></span></td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col s12 m6">
          <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Personal Info</h6>
          <table class="striped">
            <tbody>
              <tr>
                <td>Birthday:</td>
                <td>{{ $user->date_birth }}</td>
              </tr>
              <tr>
                <td>Languages:</td>
                <td>{{ $user->locale == 'en' ? 'English': '' }}</td>
              </tr>
              <tr>
                <td>Contact:</td>
                <td>{{ $user->phone }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->

  <!-- users view card details start -->
  <div class="card">
    <div class="card-content">
      {{-- <div class="row indigo lighten-5 border-radius-4 mb-2">
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Posts: <span>125</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Followers: <span>534</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Following: <span>256</span></h6>
        </div>
      </div> --}}
      <div class="row">
        <div class="col s12">
          <table class="striped">
            <tbody>
              <tr>
                <td>Username:</td>
                <td class="users-view-username">{{ $user->username }}</td>
              </tr>
              <tr>
                <td>Name:</td>
                <td class="users-view-name">{{ $user->first_name .' '. $user->last_name }}</td>
              </tr>
              <tr>
                <td>E-mail:</td>
                <td class="users-view-email">{{ $user->email }}</td>
              </tr>

            </tbody>
          </table>
          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
          <table class="striped">
            <tbody>
              <tr>
                <td>Twitter:</td>
                <td><a href="{{ $user->twitter }}">{{ $user->twitter }}</a></td>
              </tr>
              <tr>
                <td>Facebook:</td>
                <td><a href="{{ $user->facebook }}">{{ $user->facebook }}</a></td>
              </tr>
              <tr>
                <td>Skype:</td>
                <td><a href="#">{{ $user->skype }}</a></td>
              </tr>
              <tr>
                <td>Linkedin:</td>
                <td><a href="{{ $user->linkedin }}">{{ $user->linkedin }}</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <!-- users view card details ends -->

</div>
<!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
{{-- <script src="{{asset('marbia/marbia-crm/public/js/scripts/page-users.js')}}"></script> --}}
@endsection