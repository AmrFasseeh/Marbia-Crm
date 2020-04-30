<?php

namespace App\Http\Controllers;

use App\BuildingGroup;
use App\Image;
use App\Project;
use Illuminate\Http\Request;

class BuildingGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages = BuildingGroup::all();
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => 'Stages'], ['name' => "All Stages"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        return view('pages.stages.app-stages-all',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'stages' => $stages,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project = Project::findorfail($id);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => $project->title . ' Project'], ['name' => "Add Stages"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        return view('pages.stages.app-stages-add',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'project' => $id,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // dd($request);
        $validatedStage = $request->validate([
            'title' => 'required|string',
            'num_of_buildings' => 'required|numeric',
            'description' => 'string',
            'address' => 'required|string',
        ]);
            // dd($validatedStage);
        $newStage = BuildingGroup::make($validatedStage);
        $newStage->project_id = $id;
        // dd($newStage);
        $newStage->save();

        $validateImage = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->storeAs('project_images/' . $newStage->project->title, 'project-' . $newStage->project->title . '-' . $newStage->title . '.' . $request->file('image')->guessExtension());
            // $request->file('image')->store('avatars');
            // dd($path, $request->file('image'));
            if ($newStage->image) {
                // dd($user->image);
                // Storage::delete($user->image->image_path);
                $newStage->image()->update(['image_path' => $path]);
            } else {
                $newStage->image()->save(
                    Image::make(['image_path' => $path])
                );
            }
            $request->session()->flash('status', 'Stage created!');
            return redirect()->route('view.project', $id);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\BuildingGroup  $buildingGroup
     * @return \Illuminate\Http\Response
     */
    public function show($project, $stage)
    {
        $project = Project::findorfail($project);
        $stage = $project->stages->where('id', $stage)->first();
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => $project->title . ' Project'], ['name' => $stage->title],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        return view('pages.stages.app-stages-view',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'stage' => $stage,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuildingGroup  $buildingGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingGroup $buildingGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuildingGroup  $buildingGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuildingGroup $buildingGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuildingGroup  $buildingGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuildingGroup $buildingGroup)
    {
        //
    }
}
