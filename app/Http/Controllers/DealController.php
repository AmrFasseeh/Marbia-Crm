<?php

namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use App\Deal;
use App\DealStages;
use App\District;
use App\governorate;
use App\Property;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Deals"], ['name' => "All Deals"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isMenuCollapsed' => true];
        $stages = DealStages::all();
        // dd($stages);
        // dd($stages[0]->customers[0]->fullname);
        return view('pages.deals.app-deals', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'stages' => $stages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Deals"], ['name' => "Add Deals"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $stages = DealStages::all();
        $customers = Customer::where('type', 2)->get();
        $users = User::all();
        $property = Property::findorfail($id);
        $deals = Deal::all();
        // dd($stages, $customers);
        // dd($stages[0]->customers[0]->fullname);
        return view('pages.deals.app-deals-add', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'stages' => $stages,
            'customers' => $customers,
            'users' => $users,
            'property' => $property,
            // 'deals' => $deals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $property)
    {
        // dd($property);
        $validatedDeal = $request->validate([
            'title' => 'required',
            'source' => 'required',
            'value' => 'required|string',
            'due_date' => 'required|date',
            'message' => 'string',
            'payment_method' => 'required|string',
            'customer_id' => 'required|numeric',
            'deal_stages_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);
        // dd($validatedLead);
        $deal = new Deal();
        $deal->title = $validatedDeal['title'];
        $deal->source = $validatedDeal['source'];
        $deal->value = $validatedDeal['value'];
        $deal->due_date = $validatedDeal['due_date'];
        $deal->payment_method = $validatedDeal['payment_method'];
        $deal->customer_id = $validatedDeal['customer_id'];
        $deal->deal_stages_id = $validatedDeal['deal_stages_id'];
        $deal->user_id = $validatedDeal['user_id'];
        $deal->property_id = $property;
        $deal->currency = 'EGP';
        $deal->save();
        $deal->comments()->create([
            'message' => $validatedDeal['message'],
            'user_id' => Auth:: user()->id,
        ]);

        $request->session()->flash('status', 'Deal Created!');
        return redirect()->route('list.deal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deal = Deal::findorfail($id);
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Deals"], ['name' => "View ". $deal->name ." Deal"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $customer = Customer::findorfail($deal->customer_id);
        $country = Country::where('country_code', $deal->property->building->buildingGroup->project->country)->first()->country_name;
        $city = governorate::findorfail($deal->property->building->buildingGroup->project->city)->name_en;
        $district = District::findorfail($deal->property->building->buildingGroup->project->district)->name;
        $stage = DealStages::findorfail($deal->deal_stages_id);
        // dd($deal, $customer, $country, $city, $district);
        return view('pages.deals.app-deals-view', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'customer' => $customer,
            'country' => $country,
            'city' => $city,
            'district' => $district,
            'stage' => $stage,
            'deal' => $deal
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        //
    }
}
