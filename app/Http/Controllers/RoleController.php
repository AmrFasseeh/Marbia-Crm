<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Role"], ['name' => "Roles List"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        if (Auth::user()->user_type == 'admin') {
            $roles = Group::withTrashed()->get();
        }else{
            $roles = Group::all();
        }
        return view('pages.roles.page-roles-list', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'roles' => $roles,
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
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Roles"], ['name' => "Add Role"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.roles.page-roles-add',
            [
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,
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
        $role = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'required|string|max:150',
            'description' => 'required|string',
        ]);
        $new_role = new Group;
        // dd($new_role->name, $role->name);
        $new_role->name = $role['name'];
        $new_role->slug = $role['slug'];
        $new_role->description = $role['description'];
        $new_role->save();

        $request->session()->flash('status', 'Role Created!');
        return redirect()->route('list.role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Roles"], ['name' => "Edit Role"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $role = Group::findorfail($id);
        $rolePermissions = $role->permissions()->get();
        $allPermissions = Permission::all();
        // $role->assignPermissions('approve-post');
        // dd($role);
        return view('pages.roles.page-roles-edit',
            [
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,
                'role' => $role,
                'rolePermissions' => $rolePermissions,
                'allPermissions' => $allPermissions,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $permissions = Permission::all();
        $role = Group::findorfail($request->id);

        foreach ($permissions as $permission) {
            if ($request->has($permission->slug)) {
                $role->assignPermissions($permission->slug);
            } else {
                $role->revokePermissions($permission->slug);
            }
        }

        $roleDetails = $request->validate([
            'name' => 'required|string|max:199',
            'slug' => 'required|string|max:199',
            'description' => 'required|string',
        ]);

        if ($role->name != $roleDetails['name']) {
            $role->name = $roleDetails['name'];
        }
        if ($role->slug != $roleDetails['slug']) {
            $role->slug = $roleDetails['slug'];
        }
        if ($role->description != $roleDetails['description']) {
            $role->description = $roleDetails['description'];
        }
        $role->save();

        $request->session()->flash('status', 'Role Updated!');
        return redirect()->route('list.role');
        // $approve = $request->has('approve-post');
        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $role = Group::findorfail($id);
        $role->revokeAllPermissions();
        $role->delete();

        $request->session()->flash('status', 'Role Deleted!');
        return redirect()->route('list.role');
    }

    public function restore(Request $request, $id){
        $role = Group::onlyTrashed()->where('id', $id)->restore();
        
        $request->session()->flash('status', 'Role Restored!');
        return redirect()->route('list.role');
    }
}
