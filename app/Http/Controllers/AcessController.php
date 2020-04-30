<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use \Junges\ACL\Http\Models\Group;
use Illuminate\Support\Facades\DB;
use \Junges\ACL\Http\Models\Permission;
class AcessController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

    // Breadcrumbs
     $breadcrumbs = [
        ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => " Extra Components"], ['name' => "Access Controller"],
    ];
    //Pageheader set true for breadcrumbs
    $pageConfigs = ['pageHeader' => true];
 
        
        return view('pages.access-control',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }

    public function roles($role){
        if(Auth::user()){
            // check group is empty
            $group = DB::table('groups')->count();
            if($group == null){
                //if group empty add two group and assign permission
                $group = new Group;            
                $group->name = "Admin";
                $group->slug = "admin";
                $group->description = "Monitor and manage everything";
                $group->save();
                $permission = new Permission();
                $permission->name = "List User";
                $permission->slug = "list-user";
                $permission->description = "ability to view users";
                $permission->save();
                $permission = new Permission();
                $permission->name = "view User";
                $permission->slug = "view-user";
                $permission->description = "ability to view single user";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Add User";
                $permission->slug = "add-user";
                $permission->description = "ability to add users";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Edit User";
                $permission->slug = "edit-user";
                $permission->description = "ability to edit users";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Delete User";
                $permission->slug = "delete-user";
                $permission->description = "ability to delete users";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Restore User";
                $permission->slug = "restore-user";
                $permission->description = "ability to restore users";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Add Role";
                $permission->slug = "add-role";
                $permission->description = "ability to add roles";
                $permission->save();
                $permission = new Permission();
                $permission->name = "List Role";
                $permission->slug = "list-role";
                $permission->description = "ability to list roles";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Edit Role";
                $permission->slug = "edit-role";
                $permission->description = "ability to edit roles";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Delete Role";
                $permission->slug = "delete-role";
                $permission->description = "ability to delete roles";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Restore Role";
                $permission->slug = "restore-role";
                $permission->description = "ability to restore roles";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Add Permission";
                $permission->slug = "add-permission";
                $permission->description = "ability to add permissions";
                $permission->save();
                $permission = new Permission();
                $permission->name = "List Permission";
                $permission->slug = "list-permission";
                $permission->description = "ability to list permissions";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Edit Permission";
                $permission->slug = "edit-permission";
                $permission->description = "ability to edit permissions";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Delete Permission";
                $permission->slug = "delete-permission";
                $permission->description = "ability to delete permissions";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Restore Permission";
                $permission->slug = "restore-permission";
                $permission->description = "ability to restore permissions";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Add Contact";
                $permission->slug = "add-contact";
                $permission->description = "ability to add contacts";
                $permission->save();
                $permission = new Permission();
                $permission->name = "View Contact";
                $permission->slug = "view-contact";
                $permission->description = "ability to view contacts";
                $permission->save();
                $permission = new Permission();
                $permission->name = "List Contact";
                $permission->slug = "list-contact";
                $permission->description = "ability to list contacts";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Edit Contact";
                $permission->slug = "edit-contact";
                $permission->description = "ability to edit contacts";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Delete Contact";
                $permission->slug = "delete-contact";
                $permission->description = "ability to delete contacts";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Restore Contact";
                $permission->slug = "restore-contact";
                $permission->description = "ability to restore contacts";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Add Lead";
                $permission->slug = "add-lead";
                $permission->description = "ability to add lead";
                $permission->save();
                $permission = new Permission();
                $permission->name = "View Lead";
                $permission->slug = "view-lead";
                $permission->description = "ability to view lead";
                $permission->save();
                $permission = new Permission();
                $permission->name = "List Lead";
                $permission->slug = "list-lead";
                $permission->description = "ability to list lead";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Edit Lead";
                $permission->slug = "edit-lead";
                $permission->description = "ability to edit lead";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Delete Lead";
                $permission->slug = "delete-lead";
                $permission->description = "ability to delete lead";
                $permission->save();
                $permission = new Permission();
                $permission->name = "Restore Lead";
                $permission->slug = "restore-lead";
                $permission->description = "ability to restore lead";
                $permission->save();
                $group->assignAllPermissions();

                $group = new Group;            
                $group->name = "User";
                $group->slug = "user";
                $group->description = "User can only edit post.";
                $group->save();
           } 
        //    if 
            $user = Auth::user();
            $user->assignGroup('admin', 'user');
            if($role === 'admin'){
                $user->assignAllGroups();
                $admin_group = Group::where('name', 'admin')->first();

                // dd($admin_group);
                $admin_group->assignAllPermissions();
            }
            else{
                $user->revokeAllGroups();
                $user->assignGroup('user');
            }
        }
        return redirect()->back();
    }
    public function home(){
        return view('pages.dashboard-ecommerce');
    }
}
