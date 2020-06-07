<?php

namespace App\Http\Controllers;

use App\BuildingGroup;
use App\Image;
use App\Project;
use Illuminate\Http\Request;

class BuildingGroupController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
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
        }
        $request->session()->flash('status', 'Stage created!');
        return redirect()->route('view.project', $id);

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
    public function edit($id)
    {
        $stage = BuildingGroup::findorfail($id);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => $stage->project->title . ' Project'], ['name' => "Edit Stages"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];

        return view('pages.stages.app-stages-edit',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'stage' => $stage,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuildingGroup  $buildingGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuildingGroup $stage)
    {
        $validatedStage = $request->validate([
            'title' => 'required|string',
            'num_of_buildings' => 'required|numeric',
            'description' => 'string',
            'address' => 'required|string',
        ]);
        $stage->title = $validatedStage['title'];
        $stage->num_of_buildings = $validatedStage['num_of_buildings'];
        $stage->description = $validatedStage['description'];
        $stage->address = $validatedStage['address'];

        $validateImage = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->storeAs('project_images/' . $stage->project->title, 'project-' . $stage->project->title . '-' . $stage->title . '.' . $request->file('image')->guessExtension());
            // $request->file('image')->store('avatars');
            // dd($path, $request->file('image'));
            if ($stage->image) {
                // dd($user->image);
                // Storage::delete($user->image->image_path);
                $stage->image()->update(['image_path' => $path]);
            } else {
                $stage->image()->save(
                    Image::make(['image_path' => $path])
                );
            }
        }
        $stage->save();

        $request->session()->flash('status', 'Stage updated!');
        return redirect()->route('view.project', $stage->project->id);
        // dd($request, $stage);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuildingGroup  $buildingGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $stage = BuildingGroup::findorfail($id);
        foreach ($stage->buildings as $building) {

            if ($building->properties->contains('status', 1)) {
                return redirect()->back()->with('warning', 'Can\'t delete this stage as it has sold properties.');
            } else {
                foreach ($building->properties as $property) {
                    $property->delete();
                }
            }
            $building->delete();
        }
        $stage->delete();
        return redirect()->back()->with('status', 'Stage deleted!');
        // dd($stage);
    }
}
