{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Contacts edit')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/page-users.css')}}">
<style>
.col.s12.input-field {
    height: 54px;
}
</style>
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
                            <img src="{{ $contact->image ? $contact->image->url():asset('public/images/avatar/default.png') }}"
                                alt="users avatar" class="z-depth-4 circle" height="64" width="64">
                            {{-- {{ $contact->image->url() }} --}}
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading mt-0">Avatar</h5>
                            <div class="user-edit-btns display-flex">
                                <a href="#" id="change_image" class="btn-small indigo">Change</a>
                                <form id="image_form" action="{{ route('updateImage.user') }}" method="POST"
                                    enctype="multipart/form-data" hidden>
                                    @csrf
                                    <div class="getfileInput">
                                        <input type="file" id="getFile" name="image"
                                            onchange="$('#image_form').submit();">
                                        <input type="text" name="id" value="{{ $contact->id }}">
                                        {{-- <input type="submit" id="submit_btn"> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- users edit media object ends -->
                    <!-- users edit account form start -->
                    <form id="accountForm" action="{{ route('update.contact', $contact->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="fullname" name="fullname" type="text" class="validate"
                                            value="{{ $contact->fullname }}" data-error=".errorTxt1">
                                        <label for="fullname">Name</label>
                                        @error('fullname')
                                        <small class="errorTxt1">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="phone" name="phone" type="text" class="validate"
                                            value="{{ $contact->phone }}" data-error=".errorTxt2">
                                        <label for="phone">Phone</label>
                                        @error('phone')
                                        <small class="errorTxt2">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="job_title" name="job_title" type="text" class="validate"
                                            value="{{ $contact->job_title }}" data-error=".errorTxt2">
                                        <label for="last_name">Job Title</label>
                                        @error('job_title')
                                        <small class="errorTxt2">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="email" name="email" type="email" class="validate"
                                            value="{{ $contact->email }}" data-error=".errorTxt3">
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
                                        <select id="country" class="select2 browser-default" name="country">
                                            <option disabled selected>Select a country..</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->country_code }}" {{ $country->country_code == $contact->country ? 'selected':'' }}>{{ $country->country_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="country" class="active">Country</label>
                                        @error('country')
                                        <small class="errorTxt3">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <select class="select2-data-ajax browser-default city" id="city" name="city">
                                            <option disabled selected>Select City</option>
                                        </select>
                                        <label for="city" class="active">City</label>
                                        @error('city')
                                        <small class="errorTxt3">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <select class="select2-data-ajax browser-default neigh" id="neigh"
                                            name="neighbourhood">
                                            <option disabled selected>Select District</option>
                                        </select>
                                        <label for="neigh" class="active">District</label>
                                        @error('neighbourhood')
                                        <small class="errorTxt3">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="address" name="address" type="text" class="validate"
                                            value="{{ $contact->address }}" data-error=".errorTxt3">
                                        <label for="address">Address</label>
                                        @error('address')
                                        <small class="errorTxt3">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button type="submit" class="btn indigo">
                                    Save changes</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                        <!-- users edit account form ends -->
                </div>
                <div class="col s12" id="information">
                    <!-- users edit Info form start -->
                    <div class="row">
                        <div class="col s12 m6">
                            <div class="row">
                                <div class="col s12">
                                    <h6 class="mb-2"><i class="material-icons mr-1">link</i>Social Links</h6>
                                </div>
                                <div class="col s12 input-field">
                                    <input class="validate" type="text" name="twitter" value="{{ $contact->twitter }}">
                                    <label>Twitter</label>
                                </div>
                                <div class="col s12 input-field">
                                    <input class="validate" type="text" name="facebook"
                                        value="{{ $contact->facebook }}">
                                    <label>Facebook</label>
                                </div>
                                <div class="col s12 input-field">
                                    <input class="validate" type="text" name="skype" value="{{ $contact->skype }}">
                                    <label>Skype</label>
                                </div>
                                <div class="col s12 input-field">
                                    <input id="linkedin" name="linkedin" class="validate" type="text"
                                        value="{{ $contact->linkedin }}">
                                    <label for="linkedin">LinkedIn</label>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="row">
                                <div class="col s12">
                                    <h6 class="mb-2"><i class="material-icons mr-1">person_outline</i>Personal Info</h6>
                                </div>
                                <div class="col s12 input-field">
                                    <input id="datepicker" name="date_birth" type="text" name="date_birth"
                                        class="birthdate-picker date_birth"
                                        placeholder="{{ $contact->birth_date ? $contact->birth_date:'Pick a birthday' }}"
                                        data-error=".errorTxt4">
                                    <small class="errorTxt4"></small>
                                </div>
                                <div class="col s12 input-field">
                                    <select id="user_id" class="select2 browser-default" name="user_id">
                                        <option disabled selected>Select the agent..</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $contact->id }}">
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
<script src="{{asset('public/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('public/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
{{-- <script src="{{asset('public/js/scripts/page-users.js')}}"></script> --}}
<script>
    $("#change_image").on("click", function () {
        $(".getfileInput input").click();
    })


$(document).ready(function () {
    // var date = new Date();
    $('.date_birth').datepicker({
        format: "yyyy-mm-dd",
        yearRange: [1950, 2030],
    });
});

$(document).ready(function () {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#country").select2({
            dropdownAutoWidth: true,
            placeholder: "Select a Country"
        })
        $('.city').select2();
        $('.neigh').select2();
        // $("#city").select2({
        //     dropdownAutoWidth: true,
        //     dropdownParent: ".contact-compose-sidebar",
        //     placeholder: "Select a City"
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
                url: 'http://marbia.crm/ajax/getcity',
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
        
        // setTimeout(() => { console.log($('#country option:selected').val()); }, 2000);
        
        if($('#country option:selected').val() == "EG"){
            getCities("{{ $contact->country }}");
            console.log($('.city option:selected').val());
            
        }
        function getCities(country_id){
            $('.city option').remove();
            $('.neigh option').remove();
            $('.city option:eq(0)').text('Data is being loaded...');
            $.ajax({
                type: 'POST',
                url: 'http://marbia.crm/ajax/getcity',
                data: {
                    "country_code": country_id
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
                    $('.city').val("{{ $contact->city }}").change();
                }
            });
        }
        function getDistricts(city_id) {
            console.log(city_id);
            $('.neigh option').remove();
            $('.neigh option:eq(0)').text('Data is being loaded...');
            $.ajax({
                type: 'POST',
                url: 'http://marbia.crm/ajax/getdistrict',
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

                    $('.neigh').val("{{ $contact->neighbourhood }}").change();
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
                url: 'http://marbia.crm/ajax/getdistrict',
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
                    $('.neigh').val("{{ $contact->neighbourhood }}").change();
                }
            });
            // Blur the select to register the text change of the option.
            // $('.select2-data-ajax').blur();
        });

        $("#user_id").select2({
            dropdownAutoWidth: true
        });
        $('#user_id').val("{{ $contact->user_id }}").change();
    }
);
</script>
@endsection