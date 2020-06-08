{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Leads')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/rateYo/jquery.rateyo.min.css')}}">
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/page-users.css')}}">
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>
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
                        <div id="rating" class="input-field col s6">
                            <legend class="">Lead Quality</legend>
                            <div id="rate" class="rate">
                                <input type="radio" id="star5" name="lead_value" value="5" />
                                <label for="star5" title="5">5 stars</label>
                                <input type="radio" id="star4" name="lead_value" value="4" />
                                <label for="star4" title="4">4 stars</label>
                                <input type="radio" id="star3" name="lead_value" value="3" />
                                <label for="star3" title="3">3 stars</label>
                                <input type="radio" id="star2" name="lead_value" value="2" />
                                <label for="star2" title="2">2 stars</label>
                                <input type="radio" id="star1" name="lead_value" value="1" />
                                <label for="star1" title="1">1 star</label>
                            </div>
                            {{-- <label for="lead_value">Value</label> --}}
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
                                <option disabled>Choose a contact</option>
                                <option value="{{ $contact->id }}" selected>{{ $contact->fullname }}</option>
                            </select>
                            <label class="active" for="lead_source">Contact</label>
                            @error('id')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <select class="select2 browser-default contacts" name="lead_stage_id">
                                <option disabled selected>Choose a lead stage</option>
                                @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->title }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="lead_source">Stage</label>
                            @error('lead_stage_id')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <select class="select2 browser-default users" name="user_id">
                                <option disabled selected>Choose an agent</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="lead_source">Agent</label>
                            @error('user_id')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s12">
                            <textarea id="comment" class="materialize-textarea" name="message"></textarea>
                            <label for="textarea2">Comment</label>
                            @error('message')
                            <small class="errorTxt1">
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
@section('vendor-script')
<script src="{{asset('public/vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('public/vendors/formatter/jquery.formatter.min.js')}}"></script>
<script src="{{asset('public/vendors/rateYo/jquery.rateyo.min.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('public/js/custom/leads-add.js')}}"></script>
<script src="{{asset('public/js/scripts/extra-components-ratings.js')}}"></script>
@endsection