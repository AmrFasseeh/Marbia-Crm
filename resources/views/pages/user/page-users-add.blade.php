{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Users')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/select2/select2-materialize.css')}}">
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="row">
    <div class="col s12 m4 l12">
        <div id="basic-form" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Add User</h4>
                <form action="{{ route('store.user') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="fn" name="first_name"
                                class="@error('first_name') is-invalid @enderror" value="{{ old('first_name') }}"
                                required autofocus autocomplete="first_name">
                            <label for="fn">First Name</label>
                            @error('first_name')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="fn" name="last_name" class="@error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}" required autocomplete="last_name">
                            <label for="fn">Last Name</label>
                            @error('last_name')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="username" type="text" name="username"
                                class="@error('username') is-invalid @enderror" value="{{ old('username') }}" required
                                autocomplete="username">
                            <label for="username">Username</label>
                            @error('username')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="email" type="email" name="email" class="@error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autocomplete="email">
                            <label for="email">E-mail</label>
                            @error('email')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="password" type="password" name="password"
                                class="@error('password') is-invalid @enderror" autocomplete="new-password" required>
                            <label for="password">Password</label>
                            @error('password')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input id="password-confirm" type="password" name="password_confirmation"
                                autocomplete="new-password" required>
                            <label for="password-confirm">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="phone" type="text" name="phone" autocomplete="phone" required>
                            <label for="phone">Phone</label>
                            @error('phone')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col s6 input-field">
                            <input id="datepicker" name="date_birth" type="text" name="date_birth"
                                class="birthdate-picker date_birth" placeholder="Pick a birthday"
                                data-error=".errorTxt4" value="{{ @old('date_birth') }}">
                            <label for="datepicker">Birth date</label>
                            @error('date_birth')
                            <small class="errorTxt4">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6 input-field">
                            <select name="user_type">
                                <option>Select an option</option>
                                @foreach ($groups as $group)
                                <option value="{{ $group->slug }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                            <label>Role</label>
                            @error('user_type')
                            <small class="errorTxt3">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col s6 input-field">
                            <select name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Close</option>
                            </select>
                            <label>Status</label>
                            @error('status')
                            <small class="errorTxt3">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Add
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
<script>
    $(document).ready(function(){
    // var date = new Date();
  $('.date_birth').datepicker({
    format:"yyyy-mm-dd",
    yearRange: [1950, 2030],
  });
});
</script>
@endsection