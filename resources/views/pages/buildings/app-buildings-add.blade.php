{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Buildings')

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
                    <h4 class="card-title">Add a Building</h4>
                    <form action="{{ route('store.buildingToStage', $stage) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" id="building_name" name="building_name" class="@error('building_name') is-invalid @enderror"
                                    value="{{ old('building_name') }}" required autofocus autocomplete="building_name">
                                <label for="building_name">Building Name</label>
                                @error('building_name')
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
                            <div class="input-field col s6">
                                <select name="building_type" id="building_type" class="select2 browser-default" required>
                                    <option disabled selected>Select a type</option>
                                    <option value="apartment">Apartments</option>
                                    <option value="villa">Villa</option>
                                </select>
                                <label for="building_type" class="active">Building Type</label>
                                @error('building_type')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="number" id="no_of_properties" name="no_of_properties" class="@error('no_of_properties') is-invalid @enderror"
                                    value="{{ old('no_of_properties') }}" required autocomplete="no_of_properties">
                                <label for="no_of_properties">Number of properties</label>
                                @error('no_of_properties')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="number" id="sold_properties" name="sold_properties" class="@error('sold_properties') is-invalid @enderror"
                                    value="{{ old('sold_properties') }}" required autocomplete="sold_properties">
                                <label for="sold_properties">Number of sold properties</label>
                                @error('sold_properties')
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
                                <p>Upload Building Image</p>
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
        $("#building_type").select2({
            dropdownAutoWidth: true,
            placeholder: "Select building type"
        });
    });
</script>
@endsection