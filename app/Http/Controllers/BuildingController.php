<?php

namespace App\Http\Controllers;

use App\Building;
use App\BuildingGroup;
use App\Image;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::all();
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => 'Buildings'], ['name' => "All Building"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        // $build = Building::findorfail(1);

        // dd($stagee->project ,$build->buildingGroup->project);
        return view('pages.buildings.app-buildings-all',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'buildings' => $buildings,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $stage = BuildingGroup::findorfail($id);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => $stage->title], ['name' => "Add Building"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        // $build = Building::findorfail(1);

        // dd($stagee->project ,$build->buildingGroup->project);
        return view('pages.buildings.app-buildings-add',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'stage' => $id,
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
        $validatedBuilding = $request->validate([
            'building_name' => 'required|string',
            'building_type' => 'required|string',
            'description' => 'string',
            'address' => 'required|string',
            'no_of_properties' => 'required|numeric',
            'sold_properties' => 'required|numeric',
        ]);
        // dd($validatedStage);
        $newBuilding = Building::make($validatedBuilding);
        $newBuilding->building_group_id = $id;
        // dd($newStage);
        $newBuilding->save();

        $validateImage = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->storeAs('project_images/' . $newBuilding->buildingGroup->project->title, 'project-' . $newBuilding->buildingGroup->project->title . '-' . $newBuilding->buildingGroup->title . '-' . $newBuilding->building_name . '.' . $request->file('image')->guessExtension());
            // $request->file('image')->store('avatars');
            // dd($path, $request->file('image'));
            if ($newBuilding->image) {
                // dd($user->image);
                // Storage::delete($user->image->image_path);
                $newBuilding->image()->update(['image_path' => $path]);
            } else {
                $newBuilding->image()->save(
                    Image::make(['image_path' => $path])
                );
            }
        }
        $request->session()->flash('status', 'Building created!');
        return redirect()->route('view.projectStage', [$newBuilding->buildingGroup->project->id, $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => $building->buildingGroup->title], ['name' => "Edit Building"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        // $build = Building::findorfail(1);

        // dd($stagee->project ,$build->buildingGroup->project);
        return view('pages.buildings.app-buildings-edit',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'building' => $building,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        $validatedBuilding = $request->validate([
            'building_name' => 'required|string',
            'building_type' => 'required|string',
            'description' => 'string',
            'address' => 'required|string',
            'no_of_properties' => 'required|numeric',
            'sold_properties' => 'required|numeric',
        ]);
        // dd($validatedStage);
        // dd($building);
        // dd($newStage);
        $building->building_name = $validatedBuilding['building_name'];
        $building->building_type = $validatedBuilding['building_type'];
        $building->description = $validatedBuilding['description'];
        $building->address = $validatedBuilding['address'];
        $building->no_of_properties = $validatedBuilding['no_of_properties'];
        $building->sold_properties = $validatedBuilding['sold_properties'];

        $validateImage = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->storeAs('project_images/' . $building->buildingGroup->project->title, 'project-' . $building->buildingGroup->project->title . '-' . $building->buildingGroup->title . '-' . $building->building_name . '.' . $request->file('image')->guessExtension());
            // $request->file('image')->store('avatars');
            // dd($path, $request->file('image'));
            if ($building->image) {
                // dd($user->image);
                // Storage::delete($user->image->image_path);
                $building->image()->update(['image_path' => $path]);
            } else {
                $building->image()->save(
                    Image::make(['image_path' => $path])
                );
            }
        }

        $building->save();
        $request->session()->flash('status', 'Building updated!');
        return redirect()->route('view.projectStage', [$building->buildingGroup->project->id, $building->buildingGroup->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Building $building)
    {
        // dd($building);
        if ($building->properties->contains('status', 1)) {
            return redirect()->back()->with('warning', 'Can\'t delete this building as it has sold properties.');
        } else {
            foreach ($building->properties as $property) {
                $property->delete();
            }
        }
        $building->delete();
        return redirect()->back()->with('status', 'Building deleted!');
    }

}
