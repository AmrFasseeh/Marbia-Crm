<?php

namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use App\District;
use App\governorate;
use App\LeadStage;
use App\Notifications\LostLead;
use App\Notifications\NewLeadCreated;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Leads"], ['name' => "All Leads"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isMenuCollapsed' => true];

        if (LeadStage::all()->count() == null) {
            $stage = new LeadStage();
            $stage->title = 'New Lead';
            $stage->headerBg = 'blue';
            $stage->save();
            $stage = new LeadStage();
            $stage->title = 'Contacted';
            $stage->headerBg = 'yellow';
            $stage->save();
            $stage = new LeadStage();
            $stage->title = 'Proposal Sent';
            $stage->headerBg = 'red';
            $stage->save();
            $stage = new LeadStage();
            $stage->title = 'In Discussion';
            $stage->headerBg = 'orange';
            $stage->save();
            $stage = new LeadStage();
            $stage->title = 'Contact Later';
            $stage->headerBg = 'cyan';
            $stage->save();
            $stage = new LeadStage();
            $stage->title = 'Lost';
            $stage->headerBg = 'black';
            $stage->save();
            $stage = new LeadStage();
            $stage->title = 'Won';
            $stage->headerBg = 'green';
            $stage->save();
        }
        $stages = LeadStage::all();
        // dd($stages[0]->customers);
        // dd($stages[0]->customers[0]->fullname);
        return view('pages.leads.app-leads', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'stages' => $stages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Leads"], ['name' => "Add Leads"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $users = User::all();
        $contacts = Customer::where('type', 0)->get();
        $stages = LeadStage::all();
        return view('pages.leads.app-leads-add', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'users' => $users,
            'contacts' => $contacts,
            'stages' => $stages]);
    }

    public function convertToLead($id)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Leads"], ['name' => "Add Leads"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $users = User::all();
        $contacts = Customer::where('type', 0)->get();
        $stages = LeadStage::all();
        $contact = Customer::find($id);

        return view('pages.leads.app-leads-convert', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'users' => $users,
            'contacts' => $contacts,
            'stages' => $stages,
            'contact' => $contact,
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
        $validatedLead = $request->validate([
            'lead_stage_id' => 'required',
            'lead_title' => 'required|string',
            'lead_source' => 'required',
            'lead_value' => 'required|string',
            'lead_date' => 'required|date',
            'message' => 'string',
        ]);
        // dd($validatedLead);
        $lead = Customer::find($request->id);
        if ($lead->type === 0) {
            $lead->type = 1;
        } else {
            return back()->with('status', 'There is an issue with this contact!');
        }
        $lead->lead_stage_id = $validatedLead['lead_stage_id'];
        $lead->lead_title = $validatedLead['lead_title'];
        $lead->lead_source = $validatedLead['lead_source'];
        $lead->lead_value = $validatedLead['lead_value'];
        $lead->lead_date = $validatedLead['lead_date'];
        $lead->comments()->create([
            'message' => $validatedLead['message'],
            'user_id' => $request->user_id,
        ]);
        $lead->save();

        $users = User::all();
        foreach ($users as $user) {
            if ($user->hasGroup('admin')) {
                $user->notify(new NewLeadCreated($lead));
            }
        }

        $request->session()->flash('status', 'Lead Created!');
        return redirect()->route('list.lead');
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
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Leads"], ['name' => "View Leads"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $lead = Customer::where(['id' => $id])->with('leadstage')->first();
        // dd($lead);
        $country = Country::where('country_code', $lead->country)->first()->country_name;
        $city = governorate::find($lead->city)->first()->name_en;
        $district = District::find($lead->neighbourhood)->first()->name;
        // dd($contact);
        $stage = LeadStage::find($lead->lead_stage_id);

        return view('pages.leads.app-leads-view',
            [
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,
                'lead' => $lead,
                'country' => $country,
                'city' => $city,
                'district' => $district,
                'stage' => $stage,
            ]);

    }
    public function changeStage(Request $request)
    {
        if (request()->ajax()) {
            $id = substr($request->id, strpos($request->id, "_") + 1);
            $lead = Customer::findorfail($id);
            if ($request->stage_id == 7) {
                $lead->type = 2;
                $lead->cust_date = Carbon::now()->toDateTimeString();
                $lead->cust_type = 'New Customer';
                $lead->lead_stage_id = $request->stage_id;
            } else {
                $lead->type = 1;
                $lead->cust_date = null;
                $lead->cust_type = null;
                $lead->lead_stage_id = $request->stage_id;
                $users = User::all();
                foreach ($users as $user) {
                    if ($user->hasGroup('admin')) {
                        $user->notify(new LostLead($lead));
                    }
                }
            }
            $lead->save();
            // return response()->json($id);
            return response()->json($lead);
        }
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
            ['link' => "/", 'name' => "Home"], ['link' => "app-leads-list", 'name' => "Leads"], ['name' => "Edit Leads"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $lead = Customer::findorfail($id);
        $users = User::all();
        $contacts = Customer::where('type', 0)->get();
        $stages = LeadStage::all();

        return view('pages.leads.app-leads-edit', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'lead' => $lead,
            'contacts' => $contacts,
            'stages' => $stages,
            'users' => $users]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedEdit = $request->validate([
            'lead_stage_id' => 'required|numeric',
            'lead_title' => 'required|string',
            'lead_source' => 'required',
            'lead_value' => 'required|string',
            'lead_date' => 'required|date',
        ]);
        $lead = Customer::findorfail($id);
        if ($lead->lead_stage_id != $validatedEdit['lead_stage_id'] && $validatedEdit['lead_stage_id'] != null) {
            $lead->lead_stage_id = $validatedEdit['lead_stage_id'];
        }
        if ($lead->lead_title != $validatedEdit['lead_title'] && $validatedEdit['lead_title'] != null) {
            $lead->lead_title = $validatedEdit['lead_title'];
        }
        if ($lead->lead_source != $validatedEdit['lead_source'] && $validatedEdit['lead_source'] != null) {
            $lead->lead_source = $validatedEdit['lead_source'];
        }
        if ($lead->lead_value != $validatedEdit['lead_value'] && $validatedEdit['lead_value'] != null) {
            $lead->lead_value = $validatedEdit['lead_value'];
        }
        if ($lead->lead_date != $validatedEdit['lead_date'] && $validatedEdit['lead_date'] != null) {
            $lead->lead_date = $validatedEdit['lead_date'];
        }
        $lead->save();
        $request->session()->flash('status', 'Lead updated!');
        return redirect()->route('view.lead', $id);
    }

    public function wonLead($id)
    {
        $lead = Customer::findorfail($id);
        $lead->lead_stage_id = 7;
        $lead->type = 2;
        $lead->cust_date = Carbon::now()->toDateTimeString();
        $lead->cust_type = 'New Customer';
        $lead->save();
        return redirect()->back()->with('status', 'Lead Updated!');
    }

    public function lostLead($id)
    {
        $lead = Customer::findorfail($id);
        // dd($lead);
        $lead->lead_stage_id = 6;
        $lead->type = 1;
        $lead->cust_date = null;
        $lead->cust_type = null;
        $lead->save();
        $users = User::all();
        foreach ($users as $user) {
            if ($user->hasGroup('admin')) {
                $user->notify(new LostLead($lead));
            }
        }
        return redirect()->back()->with('status', 'Lead Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $lead = Customer::findorfail($id);
        if ($lead->type === 1) {
            $lead->type = 0;
        } else {

            return back()->with('status', 'There is an issue with this lead!');
        }
        $lead->lead_stage_id = null;
        $lead->lead_title = null;
        $lead->lead_source = null;
        $lead->lead_date = null;
        $lead->lead_value = null;
        $lead->save();

        $request->session()->flash('status', 'Lead deleted!');
        return redirect()->route('list.lead');

    }
}
