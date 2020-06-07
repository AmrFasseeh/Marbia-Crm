<?php

namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use App\Deal;
use App\DealStages;
use App\District;
use App\governorate;
use App\Notifications\DealWon;
use App\Notifications\NewDealCreated;
use App\Property;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
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
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Deals"], ['name' => "All Deals"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isMenuCollapsed' => true];
        $stages = DealStages::all();
        // $prop = Property::find(5);
        // dd($prop, $prop->deal);
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
            'payment_method' => 'nullable|string',
            'customer_id' => 'required|numeric',
            'deal_stages_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'payment' => 'required|string',
            'discount' => 'nullable|numeric',
            'payment_duration' => 'nullable|numeric',
            'down_payment' => 'required|numeric',

        ]);
        // dd($validatedLead);
        $deal = new Deal();
        $deal->title = $validatedDeal['title'];
        $deal->source = $validatedDeal['source'];
        $deal->value = $validatedDeal['value'];
        $deal->due_date = $validatedDeal['due_date'];
        $deal->customer_id = $validatedDeal['customer_id'];
        $deal->deal_stages_id = $validatedDeal['deal_stages_id'];
        $deal->user_id = $validatedDeal['user_id'];
        $deal->property_id = $property;
        $deal->currency = 'EGP';
        $deal->down_payment = $validatedDeal['down_payment'];

        if ($validatedDeal['payment'] == 'cash') {
            $deal->payment = $validatedDeal['payment'];
            $deal->discount = $validatedDeal['discount'];

        } elseif ($validatedDeal['payment'] == 'inst') {
            $deal->discount = 0;
            $deal->payment = $validatedDeal['payment'];
            $deal->discount = $validatedDeal['discount'];
            $deal->payment_method = $validatedDeal['payment_method'];
            $deal->payment_duration = $validatedDeal['payment_duration'];
        }

        $deal->save();
        $deal->comments()->create([
            'message' => $validatedDeal['message'],
            'user_id' => Auth::user()->id,
        ]);
        $users = User::all();
        foreach ($users as $user) {
            if ($user->hasGroup('admin')) {
                $user->notify(new NewDealCreated($deal));
            }
        }

        $request->session()->flash('status', 'Deal Created!');
        return redirect()->route('list.deal');
    }

    public function changeDealStage(Request $request)
    {
        if (request()->ajax()) {
            $id = substr($request->id, strpos($request->id, "_") + 1);
            $deal = Deal::findorfail($id);
            if ($request->stage_id == 5) {
                $now = Carbon::now()->toDateTimeString();
                $deal->deal_stages_id = 5;
                $deal->confirm_time = $now;
                $users = User::all();
                foreach ($users as $user) {
                    if ($user->hasGroup('admin')) {
                        $user->notify(new DealWon($deal));
                    }
                }
            } else {
                $deal->deal_stages_id = $request->stage_id;
            }
            $deal->save();
            // return response()->json($id);
            return response()->json($deal);
        }
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
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Deals"], ['name' => "View " . $deal->name . " Deal"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $customer = Customer::findorfail($deal->customer_id);
        $country = Country::where('country_code', $deal->property->building->buildingGroup->project->country)->first()->country_name;
        $city = governorate::findorfail($deal->property->building->buildingGroup->project->city)->name_en;
        $district = District::findorfail($deal->property->building->buildingGroup->project->district)->name;
        $stage = DealStages::findorfail($deal->deal_stages_id);

        if ($deal->payment == 'cash') {

            $value = $deal->value - $deal->down_payment;
            $discount_amount = $value * $deal->discount / 100;
            $final_value = $value - $discount_amount;

        } elseif ($deal->payment == 'inst') {
            if ($deal->payment_duration) {

                $deal_months = $deal->payment_duration * 12;
                $value = $deal->value - $deal->down_payment;
                $discount_amount = $value * $deal->discount / 100;
                $final_value = $value - $discount_amount;

                if ($deal->payment_method == 'inst_1') {
                    $rate = 'Due monthly';
                    $installments = $final_value / $deal_months;
                } elseif ($deal->payment_method == 'inst_3') {
                    $rate = 'Due every 3 months';
                    $installments = ($final_value / $deal_months) * 3;
                } elseif ($deal->payment_method == 'inst_6') {
                    $rate = 'Due every 6 months';
                    $installments = ($final_value / $deal_months) * 6;
                } elseif ($deal->payment_method == 'inst_12') {
                    $rate = 'Due yearly';
                    $installments = ($final_value / $deal_months) * 12;
                }
            }
        }

        // dd($deal, $customer, $country, $city, $district);
        return view('pages.deals.app-deals-view', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'customer' => $customer,
            'country' => $country,
            'city' => $city,
            'district' => $district,
            'stage' => $stage,
            'deal' => $deal,
            'value' => $value ?? '',
            'final_value' => $final_value ?? '',
            'installments' => $installments ?? '',
            'rate' => $rate ?? '',
            'deal_months' => $deal_months ?? '',
            'down_payment' => $deal->down_payment ?? '',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deal = Deal::findorfail($id);
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Deals"], ['name' => "View " . $deal->name . " Deal"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true];
        $stages = DealStages::all();
        $customers = Customer::where('type', 2)->get();
        $users = User::all();
        return view('pages.deals.app-deals-edit', ['pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'stages' => $stages,
            'customers' => $customers,
            'users' => $users,
            'deal' => $deal,
            // 'deals' => $deals
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $deal)
    {
        $deal = Deal::findorfail($deal);
        $validatedEdit = $request->validate([
            'title' => 'required',
            'source' => 'required',
            'value' => 'required|string',
            'due_date' => 'required|date',
            'payment_method' => 'required|string',
            'customer_id' => 'required|numeric',
            'deal_stages_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        if ($deal->title != $validatedEdit['title'] && $validatedEdit['title'] != null) {
            $deal->title = $validatedEdit['title'];
        }
        if ($deal->source != $validatedEdit['source'] && $validatedEdit['source'] != null) {
            $deal->source = $validatedEdit['source'];
        }
        if ($deal->value != $validatedEdit['value'] && $validatedEdit['value'] != null) {
            $deal->value = $validatedEdit['value'];
        }
        if ($deal->due_date != $validatedEdit['due_date'] && $validatedEdit['due_date'] != null) {
            $deal->due_date = $validatedEdit['due_date'];
        }
        if ($deal->payment_method != $validatedEdit['payment_method'] && $validatedEdit['payment_method'] != null) {
            $deal->payment_method = $validatedEdit['payment_method'];
        }
        if ($deal->customer_id != $validatedEdit['customer_id'] && $validatedEdit['customer_id'] != null) {
            $deal->customer_id = $validatedEdit['customer_id'];
        }
        if ($deal->deal_stages_id != $validatedEdit['deal_stages_id'] && $validatedEdit['deal_stages_id'] != null) {
            $deal->deal_stages_id = $validatedEdit['deal_stages_id'];
        }
        if ($deal->user_id != $validatedEdit['user_id'] && $validatedEdit['user_id'] != null) {
            $deal->user_id = $validatedEdit['user_id'];
        }
        $deal->save();
        // dd($request, $deal);
        $request->session()->flash('status', 'Deal updated!');
        return redirect()->route('view.deal', $deal);
    }

    public function wonDeal($id)
    {
        $deal = Deal::findorfail($id);
        $now = Carbon::now()->toDateTimeString();
        $deal->deal_stages_id = 5;
        $deal->confirm_time = $now;
        $deal->save();
        $users = User::all();
        foreach ($users as $user) {
            if ($user->hasGroup('admin')) {
                $user->notify(new DealWon($deal));
            }
        }
        return redirect()->back()->with('status', 'Deal Updated!');
    }

    public function lostDeal($id)
    {
        $deal = Deal::findorfail($id);
        $deal->deal_stages_id = 3;
        $deal->save();
        return redirect()->back()->with('status', 'Deal Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deal = Deal::findorfail($id);
        $deal->delete();
        return redirect()->route('list.deal')->with('status', 'Deal Deleted!');
    }
}
