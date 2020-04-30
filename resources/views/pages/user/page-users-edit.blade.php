{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users edit')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
  <div class="card">
    <div class="card-content">
      <!-- <div class="card-body"> -->
      <ul class="tabs mb-2 row">
        <li class="tab">
          <a class="display-flex align-items-center active" id="account-tab" href="#account">
            <i class="material-icons mr-1">person_outline</i><span>Account</span>
          </a>
        </li>
        <li class="tab">
          <a class="display-flex align-items-center" id="information-tab" href="#information">
            <i class="material-icons mr-2">error_outline</i><span>Information</span>
          </a>
        </li>
      </ul>
      <div class="divider mb-3"></div>
      <div class="row">
        <div class="col s12" id="account">
          <!-- users edit media object start -->
          @error('image')
          <small class="errorTxt1">
            {{ $message }}
          </small>
          <br>
          @enderror
          <div class="media display-flex align-items-center mb-2">
            <a class="mr-2" href="#">
              <img src="{{ $user->image ? $user->image->url():asset('marbia/marbia-crm/public/images/avatar/default.png') }}" alt="users avatar"
                class="z-depth-4 circle" height="64" width="64">
              {{-- {{ $user->image->url() }} --}}
            </a>
            <div class="media-body">
              <h5 class="media-heading mt-0">Avatar</h5>
              <div class="user-edit-btns display-flex">
                <a href="#" id="change_image" class="btn-small indigo">Change</a>
                <form id="image_form" action="{{ route('updateImage.user') }}" method="POST"
                  enctype="multipart/form-data" hidden>
                  @csrf
                  <div class="getfileInput">
                    <input type="file" id="getFile" name="image" onchange="$('#image_form').submit();">
                    <input type="text" name="id" value="{{ $user->id }}">
                    {{-- <input type="submit" id="submit_btn"> --}}
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- users edit media object ends -->
          <!-- users edit account form start -->
          <form id="accountForm" action="{{ route('update.user', $user->id) }}" method="POST">
            @csrf
            <div class="row">
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12 input-field">
                    <input id="username" name="username" type="text" class="validate" value="{{ $user->username }}"
                      data-error=".errorTxt1">
                    <label for="username">Username</label>
                    @error('username')
                    <small class="errorTxt1">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="first_name" name="first_name" type="text" class="validate"
                      value="{{ $user->first_name }}" data-error=".errorTxt2">
                    <label for="first_name">First Name</label>
                    @error('first_name')
                    <small class="errorTxt2">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="last_name" name="last_name" type="text" class="validate" value="{{ $user->last_name }}"
                      data-error=".errorTxt2">
                    <label for="last_name">Last Name</label>
                    @error('last_name')
                    <small class="errorTxt2">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="email" name="email" type="email" class="validate" value="{{ $user->email }}"
                      data-error=".errorTxt3">
                    <label for="email">E-mail</label>
                    @error('email')
                    <small class="errorTxt3">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12 input-field">
                    <select name="user_type">
                      @foreach ($groups as $group)
                      <option value="{{ $group->slug }}" {{ $user->user_type == $group->slug ? 'selected':''}}>
                        {{ $group->name }}</option>
                      @endforeach
                    </select>
                    <label>Role</label>
                    @error('user_type')
                    <small class="errorTxt3">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <select name="status">
                      <option value="1" {{ $user->status == 1 ? 'selected':'' }}>Active</option>
                      <option value="0" {{ $user->status == 0 ? 'selected':'' }}>Close</option>
                    </select>
                    <label>Status</label>
                    @error('status')
                    <small class="errorTxt3">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Password</label>
                    @error('password')
                    <small class="errorTxt3">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="validate">
                    <label for="password_confirmation">Confirm Password</label>
                  </div>
                </div>
              </div>
              <input type="hidden" name="id" value="{{ $user->id }}">
              <div class="col s12 display-flex justify-content-end mt-3">
                <button type="submit" class="btn indigo">
                  Save changes</button>
                <button type="button" class="btn btn-light">Cancel</button>
              </div>
            </div>
          </form>
          <!-- users edit account form ends -->
        </div>
        <div class="col s12" id="information">
          <!-- users edit Info form start -->
          <form id="infotabForm" action="{{ route('updateOthers.user', $user->id) }}" method="POST">
            @csrf
            <div class="row">
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12">
                    <h6 class="mb-2"><i class="material-icons mr-1">link</i>Social Links</h6>
                  </div>
                  <div class="col s12 input-field">
                    <input class="validate" type="text" name="twitter" value="{{ $user->twitter }}">
                    <label>Twitter</label>
                  </div>
                  <div class="col s12 input-field">
                    <input class="validate" type="text" name="facebook" value="{{ $user->facebook }}">
                    <label>Facebook</label>
                  </div>
                  <div class="col s12 input-field">
                    <input class="validate" type="text" name="skype" value="{{ $user->skype }}">
                    <label>Skype</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="linkedin" name="linkedin" class="validate" type="text" value="{{ $user->linkedin }}">
                    <label for="linkedin">LinkedIn</label>
                  </div>
                </div>
              </div>
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12">
                    <h6 class="mb-4"><i class="material-icons mr-1">person_outline</i>Personal Info</h6>
                  </div>
                  <div class="col s12 input-field">
                    <input id="datepicker" name="date_birth" type="text" name="date_birth"
                      class="birthdate-picker date_birth"
                      placeholder="{{ $user->birth_date ? $user->birth_date:'Pick a birthday' }}"
                      data-error=".errorTxt4">
                    <label for="datepicker">Birth date</label>
                    <small class="errorTxt4"></small>
                  </div>
                  <div class="col s12 input-field">
                    <select id="accountSelect" name="locale">
                      <option value="en" {{ $user->locale == 'en' ? 'selected': '' }}>English</option>
                    </select>
                    <label>Language</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="phonenumber" type="text" class="validate" name="phone" value="{{ $user->phone }}">
                    <label for="phonenumber">Phone</label>
                  </div>
                </div>
              </div>
              <input type="hidden" name="id" value="{{ $user->id }}">
              <div class="col s12 display-flex justify-content-end mt-1">
                <button type="submit" class="btn indigo">
                  Save changes</button>
                <button type="button" class="btn btn-light">Cancel</button>
              </div>
            </div>
          </form>
          <!-- users edit Info form ends -->
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('marbia/marbia-crm/public/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('marbia/marbia-crm/public/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
{{-- <script src="{{asset('marbia/marbia-crm/public/js/scripts/page-users.js')}}"></script> --}}
<script>
  $("#change_image").on("click", function () {
      $(".getfileInput input").click();
    })

    
    $(document).ready(function(){
      // var date = new Date();
    $('.date_birth').datepicker({
      format:"yyyy-mm-dd",
      yearRange: [1950, 2030],
    });
  });
</script>
@endsection
