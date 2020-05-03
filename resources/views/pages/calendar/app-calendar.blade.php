{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Calendar')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/fullcalendar/css/fullcalendar.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/fullcalendar/daygrid/daygrid.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/fullcalendar/timegrid/timegrid.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/app-calendar.css')}}">
<style>
  .modal.datepicker-modal.open {
    z-index: 5000;
    height: 405px;
    width: 100%;
  }
</style>
@endsection

{{-- page content --}}
@section('content')

<div id="modal1" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4>Add an event</h4>
    <div class="row">
      <form class="col s12" id="addEvent">
        <div class="row">
          <div class="input-field col s6">
            <input placeholder="Event title" id="title" type="text" class="validate" name="title">
            <label for="title">Title</label>
          </div>
          <div class="input-field col s6">
            <input id="description" type="text" class="validate" name="description">
            <label for="description">Description</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="start" type="text" class="validate" name="start">
            <label id="start_label" for="start">Start Date</label>
          </div>
          <div class="input-field col s6">
            <input id="end" type="text" class="validate" name="end">
            <label id="end_label" for="end">End Date</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <select name="color" id="color">
              <option value="#b71c1c" class="red darken-4">Red</option>
              <option value="#4a148c" class="purple darken-4">Purple</option>
              <option value="#1a237e" class="indigo darken-4">Indigo</option>
              <option value="#01579b" class="light-blue darken-4">Blue</option>
              <option value="#64dd17" class="light-green accent-4">Green</option>
            </select>
            <label for="color">Event Type</label>
          </div>
        </div>

    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">Add</a>
  </div>
  </form>
</div>
<!-- Full Calendar -->
<div id="app-calendar">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">
            Basic Calendar
          </h4>
          <div id="basic-calendar"></div>
        </div>
      </div>
    </div>
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">
            External Dragging
          </h4>
          <div class="row">
            <div class="col m3 s12">
              <div id='external-events'>
                <h5>Draggable Events</h5>
                <div class="fc-events-container mb-5">
                  <div class='fc-event' data-color='#009688'>All Day Event</div>
                  <div class='fc-event' data-color='#4CAF50'>Long Event</div>
                  <div class='fc-event' data-color='#00bcd4'>Meeting</div>
                  <div class='fc-event' data-color='#ff5722'>Birthday party</div>
                  <div class='fc-event' data-color='#9c27b0'>Lunch</div>
                  <div class='fc-event' data-color='#e51c23'>Conference Meeting</div>
                  <div class='fc-event' data-color='#e91e63'>Party</div>
                  <div class='fc-event' data-color='#3f51b5'>Happy Hour</div>
                  <div class='fc-event' data-color='#ffc107'>Dance party</div>
                  <div class='fc-event' data-color='#4a148c'>Dinner</div>
                  <p>
                    <label>
                      <input type="checkbox" id="drop-remove" />
                      <span>Remove After Drop</span>
                    </label>
                  </p>
                </div>
              </div>
            </div>
            <div class="col m9 s12">
              <div id='fc-external-drag'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{--vendor scripts  --}}
@section('vendor-script')
<script src="{{asset('/vendors/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('/vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('/vendors/fullcalendar/daygrid/daygrid.min.js')}}"></script>
<script src="{{asset('/vendors/fullcalendar/timegrid/timegrid.min.js')}}"></script>
<script src="{{asset('/vendors/fullcalendar/interaction/interaction.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script>
  var SITEURL = "{{url('/')}}";
           $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
           });
</script>
<script src="{{asset('/js/scripts/app-calendar.js')}}"></script>
@endsection