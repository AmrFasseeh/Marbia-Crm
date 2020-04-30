{{-- extent layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','View Building')

@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('public/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/cards-basic.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/data-tables.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> --}}
<style>
</style>
@endsection
{{-- page content --}}
@section('content')
<div class="row">
    {{-- <div class="col l12">
        <a href="{{ route('add.buildingProperty', $building->id) }}" class="btn blue">Add Property</a>
    </div> --}}
</div>
<!-- Page Length Options -->
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <h4 class="card-title">Properties</h4>
                <div class="row">
                    <div class="col s12">
                        <table id="properties" class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Project</th>
                                    <th>Stage</th>
                                    <th>Building</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Foor #</th>
                                    <th>Apartment #</th>
                                    <th>Area(Sqm)</th>
                                    <th>Bedrooms</th>
                                    <th>Bathrooms</th>
                                    <th>Kitchens</th>
                                    <th>Status</th>
                                    <th>Sell</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $property)
                                <tr>
                                    <td>{{ $property->name }}</td>
                                    <td>{{ $property->building->buildingGroup->project->title }}</td>
                                    <td>{{ $property->building->buildingGroup->title }}</td>
                                    <td>{{ $property->building->building_name }}</td>
                                    <td>{{ ucfirst($property->property_type) }}</td>
                                    <td>{{ $property->value }}</td>
                                    <td>{{ $property->floor_no }}</td>
                                    <td>{{ $property->apartment_no }}</td>
                                    <td>{{ $property->area_sqm }}</td>
                                    <td>{{ $property->bedrooms }}</td>
                                    <td>{{ $property->bathrooms }}</td>
                                    <td>{{ $property->kitchen }}</td>
                                    @if ($property->status == 0)
                                    <td><span class="users-view-status chip green lighten-5 green-text">Available</span>
                                    </td>
                                    <td><a href="#" class="btn btn-small indigo">Sell</a></td>
                                    @else
                                    <td><span class="users-view-status chip red lighten-5"><span
                                                class="red-text">Sold</span></span></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Project</th>
                                    <th>Stage</th>
                                    <th>Building</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Foor #</th>
                                    <th>Apartment #</th>
                                    <th>Area(Sqm)</th>
                                    <th>Bedrooms</th>
                                    <th>Bathrooms</th>
                                    <th>Kitchens</th>
                                    <th>Status</th>
                                    <th>Sell</th>
                                </tr>
                            </tfoot>
                        </table>
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
<script src="{{asset('public/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/jszip.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/buttons.colVis.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/js/custom/datatable/buttons.print.min.js')}}"></script>
@endsection
@section('page-script')
<script>
    $('#properties').DataTable({
    dom: 'Bfrtip',
    scrollY: '50vh',
    scrollX: true,
    scrollCollapse: true,
    paging: false,
    buttons: [
    'copy', 'excel', 'pdf', 'print'
    ]
    });

    $('.dt-buttons').find('button').each(function(){
        $(this).addClass('btn btn-small indigo');
    })
</script>
@endsection