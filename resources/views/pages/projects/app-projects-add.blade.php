{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Projects')

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
                    <h4 class="card-title">Add Project</h4>
                    <form action="{{ route('store.project') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" required autofocus autocomplete="title">
                                <label for="title">Title</label>
                                @error('first_name')
                                <small class="errorTxt1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="owner" name="owner" class="@error('owner') is-invalid @enderror"
                                    value="{{ old('owner') }}" required autocomplete="owner">
                                <label for="owner">Owner</label>
                                @error('owner')
                                <small class="errorTxt1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select id="country" class="select2 browser-default" name="country">
                                    <option disabled selected>Select a country..</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->country_code }}">{{ $country->country_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="country" class="active">Country</label>
                            </div>
                            <div class="input-field col s6">
                                <select class="select2-data-ajax browser-default city" id="city" name="city">
                                    <option disabled selected>Select a City</option>
                                </select>
                                <label for="city" class="active">City</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select class="select2-data-ajax browser-default neigh" id="neigh" name="district">
                                    <option disabled selected>Select a District</option>
                                </select>
                                <label for="neigh" class="active">District</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="location" type="text" name="location"
                                    class="@error('location') is-invalid @enderror" value="{{ old('location') }}"
                                    required autocomplete="location">
                                <label for="location">Location</label>
                                @error('location')
                                <small class="errorTxt1">
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
                                <p>Upload Project Image</p>
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

        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#country").select2({
            dropdownAutoWidth: true,
            placeholder: "Select a Country"
        });
        $("#city").select2({
            dropdownAutoWidth: true,
            placeholder: "Select a Country"
        });
        $("#neigh").select2({
            dropdownAutoWidth: true,
            placeholder: "Select a Country"
        });
        // $("#city").select2({
        // dropdownAutoWidth: true,
        // dropdownParent: ".contact-compose-sidebar",
        // placeholder: "Select a City"
        // });
        $('#country').on('change', function () {
            console.log('selected!');
            var country = $(this).val()
            console.log(country);
            $('.city option').remove();
            $('.neigh option').remove();
            $('.city option:eq(0)').text('Data is being loaded...');
            $.ajax({
                type: 'POST',
                url: SITEURL + '/ajax/getcity',
                data: {
                    "country_code": country
                }, // Any data that is needed to pass to the controller
                dataType: 'json',
                success: function (returnedData) {
                    // console.log(returnedData);

                    // Clear the notification text of the option.
                    $('.city option:eq(0)').text('');
                    // Initialize the Select2 with the data returned from the AJAX.
                    $('.city').select2({
                        data: returnedData
                    });
                    getDistricts(returnedData[0].id)
                }
            });
            // Blur the select to register the text change of the option.
            // $('.select2-data-ajax').blur();
        });

        function getDistricts(city_id) {
            console.log(city_id);
            $('.neigh option').remove();
            $('.neigh option:eq(0)').text('Data is being loaded...');
            $.ajax({
                type: 'POST',
                url: SITEURL + '/ajax/getdistrict',
                data: {
                    "id": city_id
                }, // Any data that is needed to pass to the controller
                dataType: 'json',
                success: function (returnedData) {
                    // console.log(returnedData);

                    // Clear the notification text of the option.
                    $('.neigh option:eq(0)').text('');
                    // Initialize the Select2 with the data returned from the AJAX.
                    $('.neigh').select2({
                        data: returnedData
                    });
                }
            });
        }
        $('.city').on('change', function () {
            console.log('selected!');
            var id = $(this).val()
            console.log(country);
            $('.neigh option').remove();
            $('.neigh option:eq(0)').text('Data is being loaded...');
            $.ajax({
                type: 'POST',
                url: SITEURL + '/ajax/getdistrict',
                data: {
                    "id": id
                }, // Any data that is needed to pass to the controller
                dataType: 'json',
                success: function (returnedData) {
                    // console.log(returnedData);

                    // Clear the notification text of the option.
                    $('.neigh option:eq(0)').text('');
                    // Initialize the Select2 with the data returned from the AJAX.
                    $('.neigh').select2({
                        data: returnedData
                    });
                    // Open the Select2.
                    $('.neigh').select2('open');
                }
            });
            // Blur the select to register the text change of the option.
            // $('.select2-data-ajax').blur();
        });
    });
</script>
@endsection