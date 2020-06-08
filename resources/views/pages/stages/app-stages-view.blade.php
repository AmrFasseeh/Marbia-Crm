{{-- extent layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','View Project')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/cards-basic.css')}}">
<style>
    .card .card-content img {
        min-height: 269.15px;
        max-height: 269.15px !important;
    }
</style>
@endsection

{{-- page content --}}
@section('content')
<div class="row">
    <div class="col l12">
        <a href="{{ route('add.buildingToStage', $stage->id) }}" class="btn blue">Add Building</a>
    </div>
</div>
<div class="row">
    <div class="col l4 m12 right-content border-radius-6">
        <div class="card card-default scrollspy">
            <div class="card-title pt-3 pl-5 pb-1 indigo">
                <h5 class="mt-0 white-text">{{ $stage->title }}</h5>
            </div>
            <div class="card-content">
                <p>Related to <span class="red-text">{{ $stage->project->title }}</span> project</p>
                <img class="responsive-img mt-4 p-3 border-radius-6"
                    src="{{ $stage->image ? $stage->image->url():asset('public/images/gallery/34.png')}}" alt="">
                <p class="mt-2 mb-2">{{ $stage->description }}</p>
                <hr>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Created:</b>
                    {{ Carbon\Carbon::make($stage->created_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Updated:</b>
                    {{ Carbon\Carbon::make($stage->updated_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Number of Buildings:</b>
                    {{ $stage->num_of_buildings }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Sold Buildings:</b>
                    {{ $stage->sold_buildings }}</p>
            </div>
        </div>
    </div>
    @forelse ($stage->buildings as $building)
    <div class="col l4 m12 right-content border-radius-6 mt-2">
        <div class="card card-default scrollspy">
            <div class="card-content">
                <h5 class="mt-0">{{ $building->building_name }}</h5>
                <p><span class="red-text">{{ $building->building_type }}</span></p>
                <img class="responsive-img mt-4 p-3 border-radius-6"
                    src="{{ $building->image ? $building->image->url():asset('public/images/gallery/34.png')}}" alt="">
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
                <a href="{{ route('view.building', $building->id) }}" class="btn blue mt-2">View</a>
                <a class="btn-small btn-light-blue mt-2 ml-2" href="{{ route('edit.building', $building->id) }}"><i class="material-icons">edit</i></a>
                <a class="btn-small btn-light-red mt-2 ml-2" onclick="deleteBuilding({{ $building->id }})"><i class="material-icons">delete</i></a>
                <form id="delete-building-{{ $building->id }}" action="{{ route('delete.building', $building->id) }}" method="post">@csrf</form>
            </div>
        </div>
    </div>
    @empty
    <div class="col l4 m12 right-content border-radius-6 mt-2">
        <p>No buildings for this stage yet!</p>
    </div>
    @endforelse
    @endsection
    @section('vendor-script')
<script src="{{asset('public/vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

@section('page-script')
{{-- <script src="{{asset('public/js/scripts/page-users.js')}}"></script> --}}
<script>
    function deleteBuilding(id){
        swal({
			title: "Are you sure you want to delete this building?",
			icon: 'warning',
			dangerMode: true,
			buttons: {
				cancel: 'No, Please!',
				delete: 'Yes, Delete It'
			}
		}).then(function (willDelete) {
			if (willDelete) {
                $('#delete-building-'+id).submit()
				swal("Deleting the building..", {
					icon: "success",
				});
			} else {
				swal("This building is safe", {
					title: 'Cancelled',
					icon: "error",
				});
			}
		});
    }
</script>
@endsection