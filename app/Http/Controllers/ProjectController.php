<?php

namespace App\Http\Controllers;

use App\Country;
use App\District;
use App\governorate;
use App\Image;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => " Projects"], ['name' => "List Projects"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $projects = Project::all();
        // $country = Country::findorfail($projects->country)->first(['country_name']);
        // $city = governorate::findorfail($projects->city)->first(['name_en']);
        // $district = District::findorfail($projects->district)->first(['name']);
        // dd($projects);
        return view('pages.projects.app-projects',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'projects' => $projects,
                // 'country' => $country,
                // 'city' => $city,
                // 'district' => $district,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => " Projects"], ['name' => "Add Projects"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $countries = Country::all();

        return view('pages.projects.app-projects-add',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'countries' => $countries,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedProject = $request->validate([
            'title' => 'required|string',
            'owner' => 'required|string',
            'description' => 'string',
            'country' => 'required|string',
            'city' => 'string',
            'district' => 'string',
            'location' => 'string',
        ]);

        $newProject = Project::make($validatedProject);
        // dd($newProject);
        $newProject->save();

        $validateImage = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->storeAs('project_images', 'project-' . $newProject->id . '.' . $request->file('image')->guessExtension());
            // $request->file('image')->store('avatars');
            // dd($path, $request->file('image'));
            if ($newProject->image) {
                // dd($user->image);
                // Storage::delete($user->image->image_path);
                $newProject->image()->update(['image_path' => $path]);
            } else {
                $newProject->image()->save(
                    Image::make(['image_path' => $path])
                );
            }
        }
        $request->session()->flash('status', 'Project created!');
        return redirect()->route('list.project');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => " Projects"], ['name' => "View Project"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $project = Project::findorfail($id);
        // dd($project);
        return view('pages.projects.app-projects-view',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'project' => $project,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findorfail($id);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => " Projects"], ['name' => "Edit Projects"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $countries = Country::all();
        $city = governorate::where('id', $project->city)->first();
        $district = District::where('id', $project->district)->first();

        return view('pages.projects.app-projects-edit',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'countries' => $countries,
                'project' => $project,
                'city' => $city,
                'district' => $district,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findorfail($id);
        $validatedProject = $request->validate([
            'title' => 'required|string',
            'owner' => 'required|string',
            'description' => 'string',
            'country' => 'required|string',
            'city' => 'string',
            'district' => 'string',
            'location' => 'string',
        ]);
        $project->title = $validatedProject['title'];
        $project->owner = $validatedProject['owner'];
        $project->description = $validatedProject['description'];
        $project->country = $validatedProject['country'];
        $project->city = $validatedProject['city'];
        $project->district = $validatedProject['district'];
        $project->location = $validatedProject['location'];
        // dd($request, $id);
        $validateImage = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->storeAs('project_images', 'project-' . $project->id . '.' . $request->file('image')->guessExtension());
            // $request->file('image')->store('avatars');
            // dd($path, $request->file('image'));
            if ($project->image) {
                // dd($user->image);
                // Storage::delete($user->image->image_path);
                $project->image()->update(['image_path' => $path]);
            } else {
                $project->image()->save(
                    Image::make(['image_path' => $path])
                );
            }
        }
        $project->save();
        $request->session()->flash('status', 'Project updated!');
        return redirect()->route('list.project');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $project = Project::findorfail($id);
        $stages = $project->stages;
        foreach ($stages as $stage) {
            foreach ($stage->buildings as $building) {
                if ($building->properties->contains('status', 1)) {
                    return redirect()->back()->with('warning', 'Can\'t delete this project as it has sold properties.');
                } else {
                    foreach ($building->properties as $property) {
                        $property->delete();
                    }
                }
            }
            $stage->delete();
            // dd($stage);
        }
        $project->delete();

        return redirect()->back()->with('status', 'Project deleted!');
        // dd($project->stages->first()->buildings);

    }
}
