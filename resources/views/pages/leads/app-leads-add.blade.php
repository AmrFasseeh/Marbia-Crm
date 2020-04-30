{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Leads')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2-materialize.css')}}">
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="row">
    <div class="col s12 m4 l12">
        <div id="basic-form" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Add Lead</h4>
                <form action="{{ route('store.lead') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="lead_title" name="lead_title"
                                class="@error('lead_title') is-invalid @enderror" value="{{ old('lead_title') }}"
                                required autofocus autocomplete="lead_title">
                            <label for="lead_title">Title</label>
                            @error('lead_title')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <select class="select2 browser-default source" name="lead_source">
                                <option disabled selected>Choose an option</option>
                                <option value="facebook">Facebook</option>
                                <option value="instagram">Instagram</option>
                                <option value="email">Email</option>
                                <option value="friend">Friends</option>
                                <option value="call">Calls</option>
                            </select>
                            <label class="active" for="lead_source">Source</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="lead_value" type="text" name="lead_value"
                                class="@error('lead_value') is-invalid @enderror" value="{{ old('lead_value') }}"
                                required>
                            <label for="lead_value">Value</label>
                            @error('lead_value')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col s6 input-field">
                            <input id="datepicker" name="lead_date" type="text" name="lead_date"
                                class="birthdate-picker lead_date" placeholder="Due date" data-error=".errorTxt4"
                                value="{{ @old('lead_date') }}">
                            <label for="lead_date">Due Date</label>
                            @error('lead_date')
                            <small class="errorTxt4">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select class="select2 browser-default contacts" name="id">
                                <option disabled selected>Choose a contact</option>
                                @foreach ($contacts as $contact)
                                <option value="{{ $contact->id }}">{{ $contact->fullname }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="lead_source">Contact</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="select2 browser-default contacts" name="lead_stage_id">
                                <option disabled selected>Choose a lead stage</option>
                                @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->title }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="lead_source">Stage</label>
                        </div>
                        <div class="input-field col s6">
                            <select class="select2 browser-default users" name="user_id">
                                <option disabled selected>Choose an agent</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="lead_source">Agent</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="comment" class="materialize-textarea" name="message"></textarea>
                            <label for="textarea2">Comment</label>
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
@section('vendor-script')
<script src="{{asset('public/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('public/vendors/formatter/jquery.formatter.min.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('public/js/custom/leads-add.js')}}"></script>
@endsection