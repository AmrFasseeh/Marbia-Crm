<?php

namespace App\Http\Controllers;

use App\Country;
use App\Image;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
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
            $request->session()->flash('status', 'Project created!');
            return redirect()->route('list.project');
        }
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
                'project' => $project
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
