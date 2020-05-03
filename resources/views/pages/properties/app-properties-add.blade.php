{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Property')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/dropify/css/dropify.min.css')}}">
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="app">
    <div class="row">
        <div class="col s12 m4 l12">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">Add Property</h4>
                    <form action="{{ route('store.buildingProperty', $building) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required autofocus autocomplete="name">
                                <label for="name">Property Name</label>
                                @error('name')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <select name="property_type" id="property_type" class="select2 browser-default">
                                    <option disabled selected>Select Type</option>
                                    <option value="Studio">Studio</option>
                                    <option value="Duplex">Duplex</option>
                                </select>
                                <label for="property_type" class="active">Property Type</label>
                                @error('property_type')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="number" id="num_of_properties" name="num_of_properties" class="@error('num_of_properties') is-invalid @enderror"
                                    value="{{ old('num_of_properties') }}" required autofocus autocomplete="num_of_properties">
                                <label for="num_of_properties">Number of properties</label>
                                @error('num_of_properties')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input type="number" id="floor_no_from" name="floor_no_from"
                                    class="@error('floor_no_from') is-invalid @enderror"
                                    value="{{ old('floor_no_from') }}" required autocomplete="floor_no_from">
                                <label for="floor_no_from">Floor Number (From)</label>
                                @error('floor_no_from')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="number" id="floor_no_to" name="floor_no_to"
                                    class="@error('floor_no_to') is-invalid @enderror" value="{{ old('floor_no_to') }}"
                                    required autocomplete="floor_no_to">
                                <label for="floor_no_to">Floor Number (To)</label>
                                @error('floor_no_to')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="number" id="appartment_no_from" name="appartment_no_from"
                                    class="@error('appartment_no_from') is-invalid @enderror"
                                    value="{{ old('appartment_no_from') }}" required autocomplete="appartment_no_from">
                                <label for="appartment_no_from">Apartment Number (From)</label>
                                @error('appartment_no_from')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="number" id="apartment_no_to" name="apartment_no_to"
                                    class="@error('apartment_no_to') is-invalid @enderror"
                                    value="{{ old('apartment_no_to') }}" required autocomplete="apartment_no_to">
                                <label for="apartment_no_to">Apartment Number (To)</label>
                                @error('apartment_no_to')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <input type="text" id="bedrooms" name="bedrooms"
                                    class="@error('bedrooms') is-invalid @enderror" value="{{ old('bedrooms') }}"
                                    required autocomplete="bedrooms">
                                <label for="bedrooms">Bedrooms</label>
                                @error('bedrooms')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="text" id="bathrooms" name="bathrooms"
                                    class="@error('bathrooms') is-invalid @enderror" value="{{ old('bathrooms') }}"
                                    required autocomplete="bathrooms">
                                <label for="bathrooms">Bathrooms</label>
                                @error('bathrooms')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="text" id="kitchen" name="kitchen"
                                    class="@error('kitchen') is-invalid @enderror" value="{{ old('kitchen') }}" required
                                    autocomplete="kitchen">
                                <label for="kitchen">Kitchens</label>
                                @error('kitchen')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="text" id="area_sqm" name="area_sqm"
                                    class="@error('area_sqm') is-invalid @enderror" value="{{ old('area_sqm') }}"
                                    required autocomplete="area_sqm">
                                <label for="area_sqm">Area in Sqm</label>
                                @error('area_sqm')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" id="value" name="value" class="@error('value') is-invalid @enderror"
                                    value="{{ old('value') }}" required autocomplete="value">
                                <label for="value">Value</label>
                                @error('value')
                                <small class="errorTxt1 red-text">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <select name="payment_category" id="payment_category" class="select2 browser-default">
                                    <option disabled selected>Select Payment Type</option>
                                    <option value="Full">Full</option>
                                    <option value="inst_6">6 Months Installments</option>
                                    <option value="inst_12">12 Months Installments</option>
                                    <option value="inst_18">18 Months Installments</option>
                                </select>
                                <label for="property_type" class="active">Property Type</label>
                                @error('property_type')
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
<script src="{{asset('/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('/vendors/dropify/js/dropify.min.js')}}"></script>
@endsection

@section('page-script')
<script>
    $(document).ready(function () {

        $('.dropify').dropify();
        $("#property_type").select2({
            dropdownAutoWidth: true,
            placeholder: "Select type"
        });
        $("#payment_category").select2({
            dropdownAutoWidth: true,
            placeholder: "Select payment type"
        });
    });
</script>
@endsection