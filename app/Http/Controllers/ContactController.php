<?php

namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use App\District;
use App\governorate;
use App\Notifications\NewContactCreated;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        $countries = Country::all();
        $users = User::all();
        if (Auth::user()->hasGroup('admin')) {
            $contacts = Customer::withTrashed()->get();
        } else {
            $contacts = Customer::where('user_id', Auth::user()->id)->get();
        }

        return view('pages.contacts.app-contacts',
            [
                'pageConfigs' => $pageConfigs,
                'countries' => $countries,
                'users' => $users,
                'contacts' => $contacts,
                'contacts_num' => $contacts->count(),
            ]);
    }

    public function getCities(Request $request)
    {
        if (request()->ajax()) {
            if ($request->country_code == 'EG') {
                $cities = governorate::get(['id', 'name_en']);
                $i = 0;
                foreach ($cities as $city) {
                    $data[$i] = [
                        'id' => $city->id,
                        'text' => $city->name_en];
                    $i++;
                }
                return response()->json($data);
            }
        }
    }
    public function getDistricts(Request $request)
    {
        // $districts = District::where('gov_id', 4)->get(['id', 'name']);
        // dd($districts);
        if (request()->ajax()) {
            $districts = District::where('gov_id', $request->id)->get(['id', 'name']);
            $i = 0;
            foreach ($districts as $dist) {
                $data[$i] = [
                    'id' => $dist->id,
                    'text' => $dist->name];
                $i++;
            }
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateContact = $request->validate([
            'fullname' => 'required|string',
            'country' => 'required|string',
            'city' => 'string',
            'neighbourhood' => 'string',
            'job_title' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|unique:customers',
            'user_id' => 'required|integer',
        ]);
        $contact = new Customer();
        $contact->fullname = $validateContact['fullname'];
        $contact->country = $validateContact['country'];
        $contact->job_title = $validateContact['job_title'];
        $contact->email = $validateContact['email'];
        $contact->phone = $validateContact['phone'];
        $contact->user_id = $validateContact['user_id'];
        $country = Country::where('country_code', $validateContact['country'])->first()->country_name;
        $contact->address = $country;

        if ($request->has('city')) {
            $contact->city = $validateContact['city'];
            $city = governorate::where('id', $validateContact['city'])->first()->name_en;
            $contact->address = $city . ', ' . $country;
        }
        if ($request->has('neighbourhood')) {
            $contact->neighbourhood = $validateContact['neighbourhood'];
            $district = District::where('id', $validateContact['neighbourhood'])->first()->name;
            $contact->address = $district . ', ' . $city . ', ' . $country;
        }
        $contact->save();

        $users = User::all();
        foreach($users as $user){
            if($user->hasGroup('admin')){
                $user->notify(new NewContactCreated($contact));
            }
        }
        $request->session()->flash('status', 'Contact Created!');
        return redirect()->route('list.contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "View Contacts"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $contact = Customer::findorfail($id);
        $country = Country::where('country_code', $contact->country)->first()->country_name;
        $city = governorate::find($contact->city)->name_en;
        $district = District::find($contact->neighbourhood)->name;
        // dd($contact->neighbourhood ,$contact->city ,$city, $district);
        // dd($contact);
        return view('pages.contacts.app-contacts-view',
            [
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,
                'contact' => $contact,
                'country' => $country,
                'city' => $city,
                'district' => $district,
            ]);

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
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Contacts"], ['name' => "Edit Contacts"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $contact = Customer::findorfail($id);
        $countries = Country::all();
        $users = User::all();
        return view('pages.contacts.app-contacts-edit',
            [
                'breadcrumbs' => $breadcrumbs,
                'pageConfigs' => $pageConfigs,
                'contact' => $contact,
                'countries' => $countries,
                'users' => $users,
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
        $contact = Customer::findorfail($request->id);
        // dd($contact);
        $validateContact = $request->validate([
            'fullname' => 'string',
            'country' => 'string',
            'city' => 'string',
            'neighbourhood' => 'string',
            'job_title' => 'string',
            'email' => 'email',
            'phone' => 'digits:11',
            'user_id' => 'integer',
            'address' => 'string',
        ]);
        // dd(array_key_exists ( 'fullname' , $validateContact ));
        if ($contact->fullname != $validateContact['fullname'] && $validateContact['fullname'] != null) {
            $contact->fullname = $validateContact['fullname'];
        }
        if ($contact->email != $validateContact['email'] && $validateContact['email'] != null) {
            $contact->email = $validateContact['email'];
        }
        if ($contact->phone != $validateContact['phone'] && $validateContact['phone'] != null) {
            if (!Customer::where('phone', $validateContact['phone'])->first()) {
                $contact->phone = $validateContact['phone'];
            } else {
                return back()->withErrors(['phone' => ['Phone number already used!']]);
            }
        }
        if ($contact->address != $validateContact['address'] && $validateContact['address'] != null) {
            $contact->address = $validateContact['address'];
        }
        if (array_key_exists('country', $validateContact)) {
            if ($contact->country != $validateContact['country'] && ($validateContact['country'] != null)) {
                $contact->country = $validateContact['country'];
            }
        }
        if (array_key_exists('city', $validateContact)) {
            if ($contact->city != $validateContact['city'] && $validateContact['city'] != null) {
                $contact->city = $validateContact['city'];
            }}
        if (array_key_exists('neighbourhood', $validateContact)) {
            if ($contact->neighbourhood != $validateContact['neighbourhood'] && $validateContact['neighbourhood'] != null) {
                $contact->neighbourhood = $validateContact['neighbourhood'];
            }}
        if ($contact->job_title != $validateContact['job_title'] && $validateContact['job_title'] != null) {
            $contact->job_title = $validateContact['job_title'];
        }
        if ($contact->user_id != $validateContact['user_id'] && $validateContact['user_id'] != null) {
            $contact->user_id = $validateContact['user_id'];
        }
        if ($contact->facebook != $request->facebook) {
            $contact->facebook = $request->facebook;
        }
        if ($contact->twitter != $request->twitter) {
            $contact->twitter = $request->twitter;
        }
        if ($contact->skype != $request->skype) {
            $contact->skype = $request->skype;
        }
        if ($contact->linkedin != $request->linkedin) {
            $contact->linkedin = $request->linkedin;
        }
        if ($contact->date_birth != $request->date_birth) {
            $contact->date_birth = $request->date_birth;
        }

        $contact->save();
        $request->session()->flash('status', 'Contact updated successfully!');
        return redirect()->route('view.contact', $contact->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Customer::findorfail($id);
        if ($contact->type === 0) {
            $contact->delete();
        } else if ($contact->type === 1) {
            return back()->with('status', 'Can\'t delete this contact as it is a lead right now!');
        } else if ($contact->type === 2) {
            return back()->with('status', 'Can\'t delete this contact as it is a customer right now!');
        }
        return redirect()->route('list.contact', $contact->id)->with('status', 'Contact Deleted!');
    }

    public function restore($id)
    {
        $contact = Customer::onlyTrashed()->where('id', $id)->restore();

        return redirect()->route('list.contact')->with('status', 'Contact Restored!');
    }
}
