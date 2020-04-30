{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Add Permissions')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/vendors/flag-icon/css/flag-icon.min.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="row">
    <div class="col s12 m4 l10">
        <div id="basic-form" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Add Permission</h4>
                <form action="{{ route('store.permission') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="fn" name="name">
                            <label for="fn">Name</label>
                            @error('name')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="slug" type="text" name="slug">
                            <label for="slug">Slug</label>
                            @error('slug')
                            <small class="errorTxt1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="description" type="text" name="description">
                            <label for="description">Description</label>
                            @error('description')
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