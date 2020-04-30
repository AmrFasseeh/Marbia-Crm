{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Access Control')

{{-- main page content --}}
@section('content')
<div class="section">
    <div class="roles">
    <h3>{{ Auth::user()->name }}</h3>

        <a href="access-control/admin" class="btn btn-primary mr-2">Admin<a>
                <a href="access-control/editor" class="btn btn-secondary">Editor<a>
                        <div>
                            <br>
                            @can('edit_post')
                            <button class="btn btn-primary">Only Admin</button>
                            @endcan
                        </div>
                        @endsection