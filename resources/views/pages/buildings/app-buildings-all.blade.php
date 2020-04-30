{{-- extent layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','View All Buildings')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('marbia/marbia-crm/public/css/pages/cards-basic.css')}}">
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
    {{-- <div class="col l12">
        <a href="{{ route('add.buildingToStage', $stage->id) }}" class="btn blue">Add Building</a>
    </div> --}}
</div>
<div class="row">
    @forelse ($buildings as $building)
    <div class="col l4 m12 right-content border-radius-6">
        <div class="card card-default scrollspy">
            <div class="card-content">
                <h5 class="mt-0">{{ $building->building_name }}</h5>
                <p>Related to Project: <span class="red-text">{{ $building->buildingGroup->project->title }}</span></p>
                <p>Stage: <span class="red-text">{{ $building->buildingGroup->title }}</span></p>
                <p>Type: <span class="red-text">{{ ucfirst($building->building_type) }}</span></p>
                <img class="responsive-img mt-4 p-3 border-radius-6"
                    src="{{ $building->image ? $building->image->url():asset('marbia/marbia-crm/public/images/gallery/34.png')}}" alt="">
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
                <a href="{{ route('view.building', $building->id) }}" class="btn blue mt-2">View Building</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col l4 m12 right-content border-radius-6 mt-2">
        <p>No buildings yet!</p>
    </div>
    @endforelse
    @endsection