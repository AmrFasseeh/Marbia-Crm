{{-- extent layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','View Building')

@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/cards-basic.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/data-tables.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"> --}}
<style>
</style>
@endsection
{{-- page content --}}
@section('content')
<div class="row">
    <div class="col l12">
        <a href="{{ route('add.buildingProperty', $building->id) }}" class="btn blue">Add Property</a>
    </div>
</div>
<div class="row">
    <div class="col l6 m12 right-content border-radius-6 mt-2">
        <div class="card card-default scrollspy">
            <div class="card-title pt-3 pl-5 pb-1 indigo">
                <h5 class="mt-0 white-text">{{ $building->building_name }}</h5>
            </div>
            <div class="card-content">
                <p><span class="red-text">{{ ucfirst($building->building_type) }}</span></p>
                <img class="responsive-img mt-2 p-3 border-radius-6"
                    src="{{ $building->image ? $building->image->url():asset('/images/gallery/34.png')}}" alt="">
                <p class="mt-2 mb-2">{{ $building->description }}</p>
                <hr>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Created:</b>
                    {{ Carbon\Carbon::make($building->created_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Updated:</b>
                    {{ Carbon\Carbon::make($building->updated_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Number of Properties:</b>
                    {{ $building->no_of_properties }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Sold Properties:</b>
                    {{ $building->sold_properties }}</p>
            </div>
        </div>
    </div>
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
                                    {{-- <th>
                                        <label>
                                            <input type="checkbox" class="select-all" />
                                            <span></span>
                                        </label>
                                    </th> --}}
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Foor #</th>
                                    <th>Apartment #</th>
                                    <th>Area(Sqm)</th>
                                    <th>Bedrooms</th>
                                    <th>Bathrooms</th>
                                    <th>Kitchens</th>
                                    <th>Status</th>
                                    <th>Hold</th>
                                    <th>Sell</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($building->properties as $property)
                                <tr data-id="{{ $property->id }}">
                                    {{-- <td>
                                        <label>
                                            <input type="checkbox" />
                                            <span></span>
                                        </label>
                                    </td> --}}
                                    <td>{{ $property->name }}</td>
                                    <td>{{ $property->property_type }}</td>
                                    <td>{{ number_format($property->value) }} EGP</td>
                                    <td>{{ $property->floor_no }}</td>
                                    <td>{{ $property->apartment_no }}</td>
                                    <td>{{ $property->area_sqm }}</td>
                                    <td>{{ $property->bedrooms }}</td>
                                    <td>{{ $property->bathrooms }}</td>
                                    <td>{{ $property->kitchen }}</td>
                                    @if ($property->status == 0)
                                    @if ($property->hold == 0)
                                    <td><span class="users-view-status chip green lighten-5 green-text">Available</span>
                                    </td>
                                    <td><a id="hold-btn" onclick="holdPrompt({{ $property->id }})"
                                            class="btn btn-small orange">Hold</a>
                                        <form id="hold-form-{{ $property->id }}"
                                            action="{{ route('hold.property', $property->id) }}" method="POST" hidden>
                                            @csrf
                                            <input id="hold_payment_{{ $property->id }}" type="text"
                                                name="hold_payment" hidden>
                                        </form>
                                    </td>

                                    <td><a id="sell-btn" onclick="sellPrompt({{ $property->id }})"
                                            class="btn btn-small indigo">Sell</a>
                                        <form id="sell-form-{{ $property->id }}"
                                            action="{{ route('sell.property', $property->id) }}" method="GET" hidden>
                                            @csrf</form>
                                    </td>
                                    <td>
                                        <a id="delete-btn" onclick="deletePrompt({{ $property->id }})"
                                            class="btn-small btn-light-red"><i class="material-icons">delete</i></a>
                                        <form id="delete-property-{{ $property->id }}"
                                            action="{{ route('delete.property', $property->id) }}" method="GET" hidden>
                                            @csrf</form>
                                    </td>
                                    @else
                                    <td><span class="users-view-status chip orange lighten-5 orange-text">onHold</span>
                                    </td>
                                    <td><a id="release-btn" onclick="releasePrompt({{ $property->id }})"
                                            class="btn btn-small orange">Release</a>
                                        <form id="release-form-{{ $property->id }}"
                                            action="{{ route('release.property', $property->id) }}" method="GET" hidden>
                                            @csrf</form>
                                    </td>

                                    <td><a id="sell-btn" onclick="sellPrompt({{ $property->id }})"
                                            class="btn btn-small indigo">Sell</a>
                                        <form id="sell-form-{{ $property->id }}"
                                            action="{{ route('sell.property', $property->id) }}" method="GET" hidden>
                                            @csrf</form>
                                    </td>
                                    <td>
                                        <a id="delete-btn" onclick="deletePrompt({{ $property->id }})"
                                            class="btn-small btn-light-red"><i class="material-icons">delete</i></a>
                                        <form id="delete-property-{{ $property->id }}"
                                            action="{{ route('delete.property', $property->id) }}" method="GET" hidden>
                                            @csrf</form>
                                    </td>
                                    @endif


                                    @else
                                    <td><span class="users-view-status chip red lighten-5"><span
                                                class="red-text">Sold</span></span></td>
                                    <td></td>
                                    @if ($property->deal == null)
                                    <td><a href="{{ route('add.deal', $property->id) }}"
                                            class="btn btn-small green">Deal</a></td>
                                    @else
                                    <td><span class="users-view-status chip red lighten-5"><span
                                                class="red-text">Deal&#10004;</span></span></td>
                                    @endif
                                    <td></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    {{-- <th>
                                    </th> --}}
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Foor #</th>
                                    <th>Apartment #</th>
                                    <th>Area(Sqm)</th>
                                    <th>Bedrooms</th>
                                    <th>Bathrooms</th>
                                    <th>Kitchens</th>
                                    <th>Status</th>
                                    <th>Hold</th>
                                    <th>Sell</th>
                                    <th>Delete</th>
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
<script src="{{asset('/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('/js/custom/datatable/jszip.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/buttons.colVis.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/buttons.flash.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('/js/custom/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('/vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection
@section('page-script')
<script>
    var myTable = $('#properties').DataTable({
    dom: 'Bfrtip',
    scrollY: '50vh',
    scrollX: true,
    scrollCollapse: true,
    paging: false,
    // ordering: false,
    // info: false,
    // columnDefs: [{
    //   "visible": false,
    //   "targets": 2
    // }],
    buttons: [
        'copy', 'excel', 'pdf', 'print'
    ]
});

$("#properties tbody tr").on("click", function(){
var id = $(this).attr('data-id');
console.log(id);
});


// $(window).on('load', function () {
//   $(".dropdown-content.select-dropdown li").on("click", function () {
//     var that = this;
//     setTimeout(function () {
//       if ($(that).parent().parent().find('.select-dropdown').hasClass('active')) {
//         // $(that).parent().removeClass('active');
//         $(that).parent().parent().find('.select-dropdown').removeClass('active');
//         $(that).parent().hide();
//       }
//     }, 100);
//   });
// });


// var checkbox = $('#properties tbody tr th input')
// var selectAll = $('#properties .select-all')



// // Select A Row Function


//   checkbox.on('click', function () {
//     $(this).parent().parent().parent().toggleClass('selected');
//   })

//   checkbox.on('click', function () {
//     if ($(this).attr("checked")) {
//       $(this).attr('checked', false);
//     } else {
//       $(this).attr('checked', true);
//     }


//   // Select Every Row 

//   selectAll.on('click', function () {
//     $(this).toggleClass('clicked');
//     if (selectAll.hasClass('clicked')) {
//       $('#properties tbody tr').addClass('selected');
//     } else {
//       $('#properties tbody tr').removeClass('selected');
//     }

//     if ($('#properties tbody tr').hasClass('selected')) {
//       checkbox.prop('checked', true);

//     } else {
//       checkbox.prop('checked', false);

//     }
//   })
// })

$('.dt-buttons').find('button').each(function () {
    $(this).addClass('btn btn-small indigo');
})
$('#sell-btn').on('click', function () {

})


function holdPrompt(id) {
    swal({
        title: "Enter hold payment amount:",
        content: 'input',
    }).then(function (value) {
        if (value) {
            $('#hold_payment_'+id).attr('value', value);
            $('#hold-form-' + id).submit();
            swal("Request sent!", {
                icon: "success",
            });
        } else {
            swal("Property still available", {
                title: 'Cancelled',
                icon: "error",
            });
        }
    });
}

function releasePrompt(id) {
    swal({
        title: "Are you sure you want to release this property?",
        icon: 'warning',
        dangerMode: true,
        buttons: {
            cancel: 'No, Please!',
            delete: 'Yes, Release It'
        }
    }).then(function (willDelete) {
        if (willDelete) {
            $('#release-form-' + id).submit();
            swal("Processing!", {
                icon: "success",
            });
        } else {
            swal("Property still onHold", {
                title: 'Cancelled',
                icon: "error",
            });
        }
    });
}

function sellPrompt(id) {
    swal({
        title: "Are you sure you want to sell this property?",
        icon: 'warning',
        dangerMode: true,
        buttons: {
            cancel: 'No, Please!',
            delete: 'Yes, Sell It'
        }
    }).then(function (willDelete) {
        if (willDelete) {
            $('#sell-form-' + id).submit();
            swal("Your Property is sold!", {
                icon: "success",
            });
        } else {
            swal("Property still available", {
                title: 'Cancelled',
                icon: "error",
            });
        }
    });
}
    function deletePrompt(id) {
        swal({
            title: "Are you sure you want to delete this property?",
            icon: 'warning',
            dangerMode: true,
            buttons: {
                cancel: 'No, Please!',
                delete: 'Yes, delete it'
            }
        }).then(function (willDelete) {
            if (willDelete) {
                $('#delete-property-' + id).submit();
                swal("Deleting property..", {
                    icon: "success",
                });
            } else {
                swal("Property still available", {
                    title: 'Cancelled',
                    icon: "error",
                });
            }
        })
    }

</script>
@endsection