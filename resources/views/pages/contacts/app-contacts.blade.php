{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Contacts')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('public/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/app-contacts.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/form-select2.css')}}"> --}}
<style>
  .select2-container--default .select2-selection--single {
    background-color: transparent !important;
  }

  .modal.datepicker-modal.open {
    z-index: 5000;
    height: 405px;
  }
</style>
@endsection

{{-- page content --}}
@section('content')
<!-- Add new contact popup -->
<div class="contact-overlay"></div>
<div style="bottom: 54px; right: 19px;" class="fixed-action-btn direction-top">
  <a class="btn-floating btn-large primary-text gradient-shadow contact-sidebar-trigger" href="#modal1">
    <i class="material-icons">person_add</i>
  </a>
</div>
<!-- Add new contact popup Ends-->

<!-- Sidebar Area Starts -->
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">perm_identity</i> Contacts
          </h5>
          <div class="mt-10 pt-2">
            <p class="m-0 subtitle font-weight-700">Total number of contacts</p>
            <p class="m-0 text-muted">{{ $contacts_num }} Contacts</p>
          </div>
        </div>
      </div>
      <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
        <div class="sidebar-list-padding app-sidebar sidenav" id="contact-sidenav">
          <ul class="contact-list display-grid">
            <li class="sidebar-title">Filters</li>
            <li class="active"><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2">
                  perm_identity </i> All
                Contact</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> history </i> Frequent</a>
            </li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> star_border </i> Starred
                Contacts</a></li>
            <li class="sidebar-title">Options</li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> keyboard_arrow_down </i>
                Import</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> keyboard_arrow_up </i>
                Export</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> print </i> Print</a></li>
            <li class="sidebar-title">Department</li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="purple-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Engineering</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="amber-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Sales</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i
                  class="light-green-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Support</a></li>
          </ul>
        </div>
      </div>
      <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only"><i
          class="material-icons">menu</i></a>
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->
@if (!$errors->isEmpty())
<div class="container mt-3">
  @foreach($errors->getMessages() as $key => $error)
  <h6 class="red-text darken-4">{{$error[0]}}</h6>
  @endforeach
</div>
@endif

<!-- Content Area Starts -->
<div class="content-area content-right">
  <div class="app-wrapper">
    <div class="row">
      <div class="col s11">
        <div class="datatable-search">
          <i class="material-icons mr-2 search-icon">search</i>
          <input type="text" placeholder="Search Contact" class="app-filter" id="global_filter">
        </div>
      </div>
      <div class="col s1">
        <!-- Modal Trigger -->
        <a id="add_contact" href="#"
          class="btn-large btn-floating waves-effect waves-light gradient-45deg-light-blue-cyan modal-trigger">
          <i class="material-icons">add</i>
        </a>
      </div>
    </div>
    <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
      <div class="card-content p-0">
        <table id="data-table-contact" class="display" style="width:100%">
          <thead>
            <tr>
              <th class="background-image-none center-align">
                <label>
                  <input type="checkbox" onClick="toggle(this)" />
                  <span></span>
                </label>
              </th>
              <th>User</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($contacts as $contact)
            @if (isset($contact->deleted_at))
            <tr style="text-decoration: line-through">
              @else
            <tr>
              @endif
              <td class="center-align contact-checkbox">
                <label class="checkbox-label">
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
              </td>
              <td><span class="avatar-contact avatar-online"><img src="{{asset('public/images/avatar/avatar-1.png')}}"
                    alt="avatar"></span></td>
              <td><a href="{{ route('view.contact', $contact->id) }}">{{ $contact->fullname }}</a></td>
              <td>{{ $contact->email }}</td>
              <td>{{ $contact->phone }}</td>
              @if (isset($contact->deleted_at))
              <td></td>
              <td><a href="{{ route('restore.contact', $contact->id) }}"><span><i
                      class="material-icons delete">restore</i></span></a></td>
              @else
              <td><a href="{{ route('edit.contact', $contact->id) }}"><span><i class="material-icons edit"> edit
                    </i></span></a></td>
              <td><a href="{{ route('delete.contact', $contact->id) }}"><span><i
                      class="material-icons delete">delete_outline</i></span></a></td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Content Area Ends -->

<!-- Add Contact sidebar -->
<div id="app" class="contact-compose-sidebar">
  <div class="card quill-wrapper">
    <div class="card-content pt-0">
      <div class="card-header display-flex pb-2">
        <h3 class="card-title contact-title-label">Create New Contact</h3>
        <div class="close close-icon">
          <i class="material-icons">close</i>
        </div>
      </div>
      <div class="divider"></div>
      <!-- form start -->
      <form class="edit-contact-item mb-5 mt-5" method="POST" action="{{ route('store.contact') }}">
        @csrf
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix"> perm_identity </i>
            <input id="fullname" type="text" class="validate" name="fullname">
            <label for="fullname">Name</label>
            @error('fullname')
            <small class="errorTxt4">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="input-field col s12">
            <div class="row">
              <div class="input-field col s2">
                <i class="material-icons prefix">map</i>
              </div>
              <div class="input-field col s10">
                <select id="country" class="select2 browser-default" name="country">
                  <option disabled selected>Select a country..</option>
                  @foreach ($countries as $country)
                  <option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
                  @endforeach
                </select>
                <label for="country">Country</label>
              </div>
            </div>
          </div>
          <div class="input-field col s12">
            <div class="row">
              <div class="input-field col s2">
                <i class="material-icons prefix">location_city</i>
              </div>
              <div class="input-field col s10">
                <select class="select2-data-ajax browser-default city" id="city" name="city">
                  <option disabled selected>Select City</option>
                </select>
                <label for="country">City</label>
              </div>
            </div>
          </div>
          <div class="input-field col s12">
            <div class="row">
              <div class="input-field col s2">
                <i class="material-icons prefix">location_on</i>
              </div>
              <div class="input-field col s10">
                <select class="select2-data-ajax browser-default neigh" id="neigh" name="neighbourhood">
                  <option disabled selected>Select District</option>
                </select>
                <label for="country">District</label>
              </div>
            </div>
          </div>
          <div class="input-field col s12 user_select">
            <div class="row">
              <div class="input-field col s2">
                <i class="material-icons prefix">account_circle</i>
              </div>
              <div class="input-field col s10">
                <select id="user_id" class="select2 browser-default user_id" name="user_id">
                  <option disabled selected>Select the agent..</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                  @endforeach
                </select>
                <label for="user_id">Agent</label>
              </div>
            </div>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix"> business_center </i>
            <input id="job_title" type="text" class="validate" name="job_title">
            <label for="job_title">Job Title</label>
            @error('job_title')
            <small class="errorTxt4">
              {{ $message }}
            </small>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix"> email </i>
            <input id="email" type="email" class="validate" name="email">
            <label for="email">Email</label>
            @error('email')
            <small class="errorTxt4">
              {{ $message }}
            </small>
            @enderror
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix"> call </i>
            <input id="phone" type="text" class="validate" name="phone">
            <label for="phone">Phone</label>
            @error('phone')
            <small class="errorTxt4">
              {{ $message }}
            </small>
            @enderror
          </div>
        </div>

        <div class="card-action pl-0 pr-0 right-align">
          <button type="submit" class="btn-small waves-effect waves-light add-contact">
            <span>Add Contact</span>
          </button>
          <button class="btn-small waves-effect waves-light update-contact display-none">
            <span>Update Contact</span>
          </button>
        </div>
      </form>
      <!-- form start end-->
    </div>
  </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('public/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('public/js/scripts/app-contacts.js')}}"></script>
{{-- <script src="{{asset('public/js/scripts/form-select2.js')}}"></script> --}}
<script>
  $(document).ready(function(){

   var SITEURL = "{{ url('/') }}";
    $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
           });
    $("#country").select2({
        dropdownAutoWidth: true,
        dropdownParent: ".contact-compose-sidebar",
        placeholder: "Select a Country"
    });
    // $("#city").select2({
    //     dropdownAutoWidth: true,
    //     dropdownParent: ".contact-compose-sidebar",
    //     placeholder: "Select a City"
    // });
    $('#country').on('change',function(){
      console.log('selected!');
      var country = $(this).val()
      console.log(country);
      $('.city option').remove();
      $('.neigh option').remove();
      $('.city option:eq(0)').text('Data is being loaded...');
      $.ajax({
        type: 'POST',
        url: SITEURL+'/ajax/getcity',
        data: {"country_code": country}, // Any data that is needed to pass to the controller
        dataType: 'json',
        success: function(returnedData) {
          // console.log(returnedData);
          
            // Clear the notification text of the option.
            $('.city option:eq(0)').text('');
            // Initialize the Select2 with the data returned from the AJAX.
            $('.city').select2({ data: returnedData });
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
        url: SITEURL+'/ajax/getdistrict',
        data: {"id": city_id}, // Any data that is needed to pass to the controller
        dataType: 'json',
        success: function(returnedData) {
          // console.log(returnedData);
          
            // Clear the notification text of the option.
            $('.neigh option:eq(0)').text('');
            // Initialize the Select2 with the data returned from the AJAX.
            $('.neigh').select2({ data: returnedData });
        }
    });
  }
$('.city').on('change',function(){
      console.log('selected!');
      var id = $(this).val()
      console.log(country);
      $('.neigh option').remove();
      $('.neigh option:eq(0)').text('Data is being loaded...');
      $.ajax({
        type: 'POST',
        url: SITEURL+'/ajax/getdistrict',
        data: {"id": id}, // Any data that is needed to pass to the controller
        dataType: 'json',
        success: function(returnedData) {
          // console.log(returnedData);
          
            // Clear the notification text of the option.
            $('.neigh option:eq(0)').text('');
            // Initialize the Select2 with the data returned from the AJAX.
            $('.neigh').select2({ data: returnedData });
            // Open the Select2.
            $('.neigh').select2('open');
        }
    });
    // Blur the select to register the text change of the option.
    // $('.select2-data-ajax').blur();
});
    
    $("#user_id").select2({
        dropdownAutoWidth: true,
        dropdownParent: ".user_select"
    });

    $(".contact-sidebar-trigger").on("click", function () {
      $(".contact-overlay").addClass("show");
      $(".update-contact").addClass("display-none");
      $(".add-contact").removeClass("display-none");
      $(".contact-compose-sidebar").addClass("show");
      $("label[for]").removeClass("active");
      $(".contact-compose-sidebar input").val("");
   })

    $(
      ".contact-compose-sidebar .update-contact, .contact-compose-sidebar .close-icon, .contact-compose-sidebar .add-contact, .contact-overlay"
   ).on("click", function () {
      $(".contact-overlay").removeClass("show");
      $(".contact-compose-sidebar").removeClass("show");
   });

   $("#add_contact").on("click", function () {
      $(".update-contact").addClass("display-none");
      $(".add-contact").removeClass("display-none");
      $(".contact-overlay").addClass("show");
      $(".contact-compose-sidebar").addClass("show");
      $("label[for]").addClass("active");
   }).on("click", ".checkbox-label,.favorite,.delete", function (e) {
      e.stopPropagation();
   })

   if ($(".contact-compose-sidebar").length > 0) {
      var ps_compose_sidebar = new PerfectScrollbar(".contact-compose-sidebar", {
         theme: "dark",
         wheelPropagation: false
      });
   }
  });
</script>
@endsection