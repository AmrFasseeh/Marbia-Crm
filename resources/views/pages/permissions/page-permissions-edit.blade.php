{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Edit Permissions')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/page-users.css')}}">
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
                        <i class="material-icons mr-1">person_outline</i><span>Permission Details</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit media object start -->
                    <div class="media display-flex align-items-center mb-2">
                        <div class="media-body">
                            <h5 class="media-heading mt-0"><span style="font-weight: bold">Permission:</span>
                                {{ $permission->name }}</h5>
                        </div>
                    </div>
                    <!-- users edit media object ends -->
                    <!-- users edit account form start -->
                    <form id="permissionForm" action="{{ route('update.permission') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="name" name="name" type="text" class="validate"
                                            value="{{ $permission->name }}" data-error=".errorTxt1">
                                        <label for="name">Name</label>
                                        @error('name')
                                        <small class="errorTxt1">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="slug" name="slug" type="text" class="validate"
                                            value="{{ $permission->slug }}" data-error=".errorTxt2">
                                        <label for="slug">Slug</label>
                                        @error('slug')
                                        <small class="errorTxt2">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="description" name="description" type="text" class="validate"
                                            value="{{ $permission->description }}" data-error=".errorTxt3">
                                        <label for="email">Description</label>
                                        @error('description')
                                        <small class="errorTxt3">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 display-flex justify-content-end mt-3">
                                <input type="hidden" name="id" id="id" value="{{ $permission->id }}">
                                <button type="submit" class="btn indigo">
                                    Save changes</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
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
<script src="{{asset('/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('/js/scripts/page-users.js')}}"></script>
@endsection