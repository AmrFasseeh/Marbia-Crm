<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Http\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Permissions"], ['name' => "Permissions List"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        if (Auth::user()->user_type == 'admin') {
            $permissions = Permission::withTrashed()->get();
        }else{
            $permissions = Permission::all();
        }
        return view('pages.permissions.page-permissions-list', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'permissions' => $permissions,
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
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Permissions"], ['name' => "Add Permission"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.permissions.page-permissions-add',
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
        $permission = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'required|string|max:150',
            'description' => 'required|string',
        ]);
        $new_permission = new Permission;
        $admin = Group::where('slug', 'admin')->first();
        // dd($new_role->name, $role->name);
        $new_permission->name = $permission['name'];
        $new_permission->slug = $permission['slug'];
        $new_permission->description = $permission['description'];
        $new_permission->save();
        $admin->assignPermissions($new_permission->slug);

        $request->session()->flash('status', 'Permission Created!');
        return redirect()->route('list.permission');
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
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Permissions"], ['name' => "Edit Permissions"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $permission = Permission::findorfail($id);
        
        return view('pages.permissions.page-permissions-edit',
            [
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,
                'permission' => $permission
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
        $permission = Permission::findorfail($request->id);
        $permissionDetails = $request->validate([
            'name' => 'required|string|max:199',
            'slug' => 'required|string|max:199',
            'description' => 'required|string',
        ]);

        if ($permission->name != $permissionDetails['name']) {
            $permission->name = $permissionDetails['name'];
        }
        if ($permission->slug != $permissionDetails['slug']) {
            $permission->slug = $permissionDetails['slug'];
        }
        if ($permission->description != $permissionDetails['description']) {
            $permission->description = $permissionDetails['description'];
        }
        $permission->save();

        $request->session()->flash('status', 'Permission Updated!');
        return redirect()->route('list.permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $permission = Permission::findorfail($id);
        $permission->delete();

        $request->session()->flash('status', 'Permission Deleted!');
        return redirect()->route('list.permission');
    }

    public function restore(Request $request, $id){
        $permission = Permission::onlyTrashed()->where('id', $id)->restore();
        
        $request->session()->flash('status', 'Permission Restored!');
        return redirect()->route('list.permission');
    }
}
