{{-- extent layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Projects')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/pages/cards-basic.css')}}">
<style>
.card .card-image img {
    height: 269.15px;
}
</style>
@endsection

{{-- page content --}}
@section('content')
<div class="row">
    <div class="col s12">
        <a href="{{ route('add.project') }}"
            class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2">Add Project</a>
    </div>
    @forelse ($projects as $project)
    <div class="col s4 m6 l4">
        <div class="card sticky-action">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="{{ $project->image ? $project->image->url() : asset('public/images/gallery/21.png')}}" alt="" />
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">{{ $project->title }} <i
                        class="material-icons right">more_vert</i>
                </span>
                <p>{{ $project->description }}</p>
            </div>
            <div class="card-action"><a href="{{ route('view.project', $project->id) }}" class="btn waves-effect waves-light blue lightrn-1">View Project</a>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">{{ $project->title }} <i
                        class="material-icons right">close</i>
                </span>
                <p>{{ $project->location }}</p>
                @if (isset($project->district))
                <p>{{  App\District::where('id', $project->district)->first()->name . ', '. App\governorate::where('id', $project->city)->first()->name_en . ', ' . App\Country::where('country_code', $project->country)->first()->country_name }}
                </p>
                @elseif(!isset($project->district) && isset($project->city))
                <p>{{ App\governorate::where('id', $project->city)->first()->name_en . ', ' . App\Country::where('country_code', $project->country)->first()->country_name }}
                </p>
                @else
                <p>{{ App\Country::where('country_code', $project->country)->first()->country_name }}
                </p>
                @endif
                <a href="{{ route('edit.project', $project->id) }}" class="btn waves-effect waves-light blue lightrn-1 mb-4">Edit Project</a>
                <a onclick="deletePrompt({{ $project->id }})" class="btn waves-effect waves-light red lightrn-1">Delete Project</a>
                <form id="delete_project_{{ $project->id }}" action="{{ route('delete.project', $project->id) }}" method="post" hidden>
                @csrf</form>
            </div>
        </div>
    </div>
    @empty
    <div class="col s12">
        <p>No projects yet!</p>
    </div>
    @endforelse
</div>
@endsection
@section('vendor-script')
<script src="{{asset('public/vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection
@section('page-script')
<script>
    function deletePrompt(id){
        swal({
			title: "Are you sure you want to delete this Project?",
            text: "All stages, buildings and properites that are related to this project will be deleted!",
			icon: 'warning',
			dangerMode: true,
			buttons: {
				cancel: 'No, Please!',
				delete: 'Yes, Delete It'
			}
		}).then(function (willDelete) {
			if (willDelete) {
                $('#delete_project_'+id).submit()
				swal("This project was deleted!", {
					icon: "success",
				});
			} else {
				swal("This project is safe", {
					title: 'Cancelled',
					icon: "error",
				});
			}
		});
    }
</script>
@endsection