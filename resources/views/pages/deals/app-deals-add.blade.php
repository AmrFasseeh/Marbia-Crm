{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Deals')

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
                <h4 class="card-title">Add a Deal</h4>
                <h6>Deal for <span class="red-text">{{ $property->name }}</span> property</h6>
                <form action="{{ route('store.deal', $property->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="title" name="title"
                                class="@error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required autofocus autocomplete="title">
                            <label for="title">Title</label>
                            @error('title')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <select class="select2 browser-default source" name="source">
                                <option disabled selected>Choose an option</option>
                                <option value="facebook">Facebook</option>
                                <option value="instagram">Instagram</option>
                                <option value="email">Email</option>
                                <option value="friend">Friends</option>
                                <option value="call">Calls</option>
                            </select>
                            <label class="active" for="source">Source</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="value" type="text" name="value"
                                class="@error('value') is-invalid @enderror" value="{{ old('value') }}"
                                required>
                            <label for="value">Value</label>
                            @error('value')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col s6 input-field">
                            <input id="datepicker" name="due_date" type="text" name="due_date"
                                class="birthdate-picker due_date" placeholder="Due date" data-error=".errorTxt4"
                                value="{{ @old('due_date') }}">
                            <label for="datepicker">Due Date</label>
                            @error('due_date')
                            <small class="errorTxt4">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select id="customer_id" class="select2 browser-default contacts" name="customer_id">
                                <option disabled selected>Choose a customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="customer_id">Customer</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="deal_stages_id" class="select2 browser-default contacts" name="deal_stages_id">
                                <option disabled selected>Choose a deal stage</option>
                                @foreach ($stages as $stage)
                                <option value="{{ $stage->id }}">{{ $stage->title }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="deal_stages_id">Stage</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="user_id" class="select2 browser-default users" name="user_id">
                                <option disabled selected>Choose an agent</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                                @endforeach
                            </select>
                            <label class="active" for="user_id">Agent</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="payment_method" class="select2 browser-default payment_method" name="payment_method">
                                <option disabled selected>Choose a payment method</option>
                                <option value="full">Full</option>
                                <option value="inst_6">6 Months Installments</option>
                                <option value="inst_12">12 Months Installments</option>
                                <option value="inst_18">18 Months Installments</option>
                            </select>
                            <label class="active" for="payment_method">Payment Method</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="comment" class="materialize-textarea" name="message"></textarea>
                            <label for="comment">Comment</label>
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
<script src="{{asset('public/js/custom/deals-add.js')}}"></script>
@endsection