{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Stages')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/dropify/css/dropify.min.css')}}">
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="app">
    <div class="row">
        <div class="col s12 m4 l12">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">Add Stage</h4>
                    <form action="{{ route('store.projectStage', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" required autofocus autocomplete="title">
                                <label for="title">Title</label>
                                @error('title')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="number" id="num_of_buildings" name="num_of_buildings" class="@error('num_of_buildings') is-invalid @enderror"
                                    value="{{ old('num_of_buildings') }}" required autocomplete="num_of_buildings">
                                <label for="num_of_buildings">Number of buildings</label>
                                @error('num_of_buildings')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" id="address" name="address" class="@error('address') is-invalid @enderror"
                                    value="{{ old('address') }}" required autocomplete="address">
                                <label for="address">Address</label>
                                @error('address')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea name="description" id="description" class="materialize-textarea"></textarea>
                                <label for="description">Description</label>
                            </div>
                            <div class="col s12 m4 l3">
                                <p>Upload Stage Image</p>
                            </div>
                            <div class="col s12 m8 l9">
                                <input type="file" id="image" class="dropify" name="image" data-default-file="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit"
                                        name="action">Add
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
</div>
@endsection

@section('vendor-script')
<script src="{{asset('marbia/marbia-crm/public/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('marbia/marbia-crm/public/vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

@section('page-script')
<script>
    $(document).ready(function () {

        $('.dropify').dropify();
    });
</script>
@endsection