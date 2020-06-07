{{-- extent layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','View Project')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/cards-basic.css')}}">
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
        <a href="{{ route('add.projectStage', $project->id) }}" class="btn blue">Add Stage</a>
    </div>
</div>
<div class="row">
    <div class="col l4 m12 right-content border-radius-6">
        <div class="card card-default scrollspy">
            <div class="card-title pt-3 pl-5 pb-1 indigo">
                <h5 class="mt-0 white-text">{{ $project->title }}</h5>
            </div>
            <div class="card-content">
                <p>Owned by {{ $project->owner }}</p>
                <img class="responsive-img mt-4 p-3 border-radius-6"
                    src="{{ $project->image ? $project->image->url() : asset('/images/gallery/34.png')}}" alt="">
                <p class="mt-2 mb-2">{{ $project->description }}</p>
                <hr>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Created:</b>
                    {{ Carbon\Carbon::make($project->created_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Stages:</b> {{ $project->stages->count() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Lastest Update:</b>
                    {{ Carbon\Carbon::make($project->updated_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Location:</b> {{ $project->location }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Address:</b>
                    @if (isset($project->district))
                    <p>
                        {{  App\District::where('id', $project->district)->first()->name 
                        . ', '. App\governorate::where('id', $project->city)->first()->name_en 
                        . ', ' . App\Country::where('country_code', $project->country)->first()->country_name }}
                    </p>
                    @elseif(!isset($project->district) && isset($project->city))<p>
                        {{ App\governorate::where('id', $project->city)->first()->name_en 
                        . ', ' . App\Country::where('country_code', $project->country)->first()->country_name }}
                    </p>
                    @else<p>{{ App\Country::where('country_code', $project->country)->first()->country_name }}</p>
                    @endif</p>
            </div>
        </div>
    </div>
    @forelse ($project->stages as $stage)
    <div class="col l4 m12 right-content border-radius-6 mt-2">
        <div class="card card-default scrollspy">
            <div class="card-content">
                <h5 class="mt-0">{{ $stage->title }}</h5>
                <p>Related to <span class="red-text">{{ $project->title }}</span> project</p>
                <img class="responsive-img mt-4 p-3 border-radius-6"
                    src="{{ $stage->image ? $stage->image->url():asset('/images/gallery/34.png')}}" alt="">
                <p class="mt-2 mb-2">{{ $stage->description }}</p>
                <hr>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Created:</b>
                    {{ Carbon\Carbon::make($stage->created_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Updated:</b>
                    {{ Carbon\Carbon::make($stage->updated_at)->toDateString() }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Number of Buildings:</b>
                    {{ $stage->num_of_buildings }}</p>
                <p class="mt-2"><b class="blue-grey-text text-darken-4">Sold Buildings:</b> {{ $stage->sold_buildings }}
                </p>
                <a href="{{ route('view.projectStage', [$project->id, $stage->id]) }}"
                    class="btn-small blue mt-2">View</a>
                <a class="btn-small btn-light-blue mt-2 ml-2" href="{{ route('edit.projectStage', $stage->id) }}"><i
                        class="material-icons">edit</i></a>
                <a class="btn-small btn-light-red mt-2 ml-2" onclick="deleteStage({{ $stage->id }})"><i
                        class="material-icons">delete</i></a>
                <form id="delete-stage-{{ $stage->id }}" action="{{ route('delete.projectStage', $stage->id) }}"
                    method="post">@csrf</form>
            </div>
        </div>
    </div>
    @empty
    <div class="col l4 m12 right-content border-radius-6 mt-2">
        <p>No stages for this project yet!</p>
    </div>
    @endforelse
    @endsection

    @section('vendor-script')
    <script src="{{asset('/vendors/sweetalert/sweetalert.min.js')}}"></script>
    @endsection

    @section('page-script')
    {{-- <script src="{{asset('/js/scripts/page-users.js')}}"></script> --}}
    <script>
        function deleteStage(id){
        swal({
			title: "Are you sure you want to delete this stage?",
			icon: 'warning',
			dangerMode: true,
			buttons: {
				cancel: 'No, Please!',
				delete: 'Yes, Delete It'
			}
		}).then(function (willDelete) {
			if (willDelete) {
                $('#delete-stage-'+id).submit()
				swal("This stage was deleted!", {
					icon: "success",
				});
			} else {
				swal("This stage is safe", {
					title: 'Cancelled',
					icon: "error",
				});
			}
		});
    }
    </script>
    @endsection