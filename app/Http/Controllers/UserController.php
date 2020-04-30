<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdate;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Junges\ACL\Http\Models\Group;
use Junges\ACL\Traits\UsersTrait;

class UserController extends Controller
{
    use UsersTrait;

    public function usersList()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users List"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        if (Auth::user()->user_type == 'admin') {
            $users = User::withTrashed()->get();
        }else{
            $users = User::all();
        }
        return view('pages.user.page-users-list', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'users' => $users,
        ]);
    }
    public function usersView($user)
    {
        // dd($user);
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users View"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $user = User::findorfail($user);

        return view('pages.user.page-users-view', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
        ]);
    }
    public function usersEdit($id)
    {
        // dd($id);
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users Edit"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $user = User::findorfail($id);
        $groups = Group::all();
        // dd($groups);
        return view('pages.user.page-users-edit', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
            'groups' => $groups,
        ]);
    }
    public function usersImageUpdate(Request $request)
    {
        $user = User::findorfail($request->id);

        $validateImage = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|dimensions:ratio=1/1',
        ]);
        if ($request->file('image')) {
            $path = $request->file('image')->storeAs('user_images', 'user-' . $user->id . '.' . $request->file('image')->guessExtension());
            // $request->file('image')->store('avatars');
            // dd($path, $request->file('image'));
            if ($user->image) {
                // dd($user->image);
                // Storage::delete($user->image->image_path);
                $user->image()->update(['image_path' => $path]);
            } else {
                $user->image()->save(
                    Image::make(['image_path' => $path])
                );
            }
            $request->session()->flash('status', 'Image Changed!');
            return redirect()->back();
        }

    }

    public function usersUpdate(UserUpdate $request)
    {
        $validatedUser = $request->validated();

        // dd($validatedUser, $request->id);
        $user = User::findorfail($request->id);
        if ($user->username != $validatedUser['username']) {
            $user->username = $validatedUser['username'];
        }
        if ($user->first_name != $validatedUser['first_name']) {
            $user->first_name = $validatedUser['first_name'];
        }
        if ($user->last_name != $validatedUser['last_name']) {
            $user->last_name = $validatedUser['last_name'];
        }
        if (Hash::check($validatedUser['password'], $user->password)) {
            $user->password = Hash::make($validatedUser['password']);
        }
        if ($user->email != $validatedUser['email']) {
            $user->email = $validatedUser['email'];
        }
        if ($user->user_type != $validatedUser['user_type']) {
            $user->user_type = $validatedUser['user_type'];
            $user->revokeAllGroups();
            $user->assignGroup($validatedUser['user_type']);
        }
        if ($user->status != $validatedUser['status']) {
            $user->status = $validatedUser['status'];
        }

        $user->save();
        // dd($user);
        $request->session()->flash('status', 'User updated successfully!');
        return redirect()->route('view.user', $user->id);
    }

    public function usersUpdateOthers(Request $request)
    {
        $user = User::findorfail($request->id);

        // dd($user);

        if ($user->facebook != $request->facebook) {
            $user->facebook = $request->facebook;
        }
        if ($user->twitter != $request->twitter) {
            $user->twitter = $request->twitter;
        }
        if ($user->skype != $request->skype) {
            $user->skype = $request->skype;
        }
        if ($user->linkedin != $request->linkedin) {
            $user->linkedin = $request->linkedin;
        }
        if ($user->date_birth != $request->date_birth) {
            $user->date_birth = $request->date_birth;
        }
        if ($user->locale != $request->locale) {
            $user->locale = $request->locale;
        }
        if ($user->phone != $request->phone) {
            $user->phone = $request->phone;
        }

        $user->save();
        // dd($user);
        $request->session()->flash('status', 'User updated successfully!');
        return redirect()->route('view.user', $user->id);

    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Users"], ['name' => "Add User"]];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        $groups = Group::all();
        return view('pages.user.page-users-add',
            [
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,
                'groups' => $groups,
            ]);
    }
    public function store(Request $request)
    {
        // dd($request->user_type);
        $user = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'digits:11'],
            'date_birth' => ['required', 'date'],
            'user_type' => ['required', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $newuser = new User();

        $newuser->first_name = $user['first_name'];
        $newuser->last_name = $user['last_name'];
        $newuser->username = $user['username'];
        $newuser->email = $user['email'];
        $newuser->password = Hash::make($user['password']);
        $newuser->phone = $user['phone'];
        $newuser->date_birth = $user['date_birth'];
        $newuser->user_type = $user['user_type'];
        $newuser->status = $user['status'];
        $newuser->locale = 'en';
        
        $newuser->save();
        $newuser->assignGroup($user['user_type']);
        $request->session()->flash('status', 'User Created!');

        return redirect()->route('list.user');
    }

    public function destroy(Request $request, $id)
    {
        // dd($id);
        // dd(User::all());
        $user = User::findorfail($id);
        // dd($user);
        $user->delete();

        $request->session()->flash('status', 'User Deleted!');
        return redirect()->route('list.user');
    }

    public function restore(Request $request, $id){
        $user = User::onlyTrashed()->where('id', $id)->restore();
        
        $request->session()->flash('status', 'User Restored!');
        return redirect()->route('list.user');
    }
}
