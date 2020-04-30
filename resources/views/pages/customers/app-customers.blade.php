{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Customers')

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
{{-- <link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/form-select2.css')}}"> --}}
@endsection

{{-- page content --}}
@section('content')
<div class="content-area content-right">
    <div class="app-wrapper">
        <div class="row">
            <div class="col m7 l12">
                <div class="card m7">
                    <div class="card-content">
                        <h4 class="card-title">Customers List
                        </h4>
                        <div class="row">
                            <div class="col s12">
                                <table id="scroll-dynamic" class="display">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Contact Since</th>
                                            <th>Lead Due Date</th>
                                            <th>Customer Since</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->fullname }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ Carbon\Carbon::make($customer->created_at)->toDateString() }}</td>
                                            <td>{{ Carbon\Carbon::make($customer->lead_date)->toDateString() }}</td>
                                            <td>{{ Carbon\Carbon::make($customer->cust_date)->toDateString() }}</td>
                                            <td>{{ $customer->lead_value }}</td>
                                        </tr>
                                        @empty
                                            <td colspan="7">No customers yet</td>
                                        @endforelse 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Contact Since</th>
                                            <th>Lead Due Date</th>
                                            <th>Customer Since</th>
                                            <th>Value</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('vendor-script')
<script src="{{asset('public/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/vendors/select2/select2.full.min.js')}}"></script>
@endsection