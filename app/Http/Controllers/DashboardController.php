<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Deal;
use App\Notifications\InstallmentDueToday;
use App\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public static function numberAbbreviation($number)
    {
        $abbrevs = array(12 => "T", 9 => "B", 6 => "M", 3 => "K", 0 => "");

        foreach ($abbrevs as $exponent => $abbrev) {
            if ($number >= pow(10, $exponent)) {
                $display_num = $number / pow(10, $exponent);
                $decimals = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
                return number_format($display_num, $decimals) . $abbrev;
            }
        }
    }

    public function dashboardModern()
    {
        $deals = Deal::where('deal_stages_id', 5)->get();
        $balance = $deals->sum('value');
        // dd($balance);
        $today = new Carbon();
        $short_balance = DashboardController::numberAbbreviation($balance);
        $contacts = Customer::all();
        $new_contacts = $contacts->where('created_at', '>=', $today->toDateString())->count();
        $latest_contacts = Customer::orderBy('id', 'desc')->take(5)->get();
        $latest_deals = Deal::orderBy('id', 'desc')->take(3)->get();
        $last_deal_value = Deal::where('deal_stages_id', 5)
            ->where('updated_at', '>=', '$today->toDateString()')->orderBy('id', 'desc')->first();
        $today_deals = Deal::where('deal_stages_id', 5)
            ->where('updated_at', '>=', '$today->toDateString()')->orderBy('id', 'desc')->get();
        $today_deals_count = $today_deals->count();
        // dd($last_deal_value);
        $users = User::all();

        $now = Carbon::now()->addMonth();
        // dd($now->toDateString(), Deal::find(10)->confirm_time, $now->toDateString() == Carbon::make(Deal::find(10)->confirm_time)->toDateString());
        foreach ($deals as $deal) {
            // dump($deal->payment_method);
            if ($deal->payment_method == 'inst_1') {
                $now = Carbon::now();
                // dd($deal->title, $now->addDay()->toDateString() == Carbon::make($deal->confirm_time)->addMonth()->addDay()->toDateString(), $now->toDateString(), $deal->confirm_time);

                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addMonth()->toDateString()) {
                    if ($deal->notification_status == 0) {
                        foreach ($users as $user) {
                            if ($user->hasGroup('admin')) {
                                $deal->notification_status = 1;
                                $user->notify(new InstallmentDueToday($deal));
                                $deal->save();
                                // dd('here');
                            }
                        }
                    }
                }
                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addMonth()->addDay()->toDateString()) {
                    // dd('here');
                    $deal->notification_status = 0;
                }
            } elseif ($deal->payment_method == 'inst_3') {
                $now = Carbon::now();

                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addMonths(3)->toDateString()) {
                    if ($deal->notification_status == 0) {
                        foreach ($users as $user) {
                            if ($user->hasGroup('admin')) {
                                $deal->notification_status = 1;
                                $user->notify(new InstallmentDueToday($deal));
                                $deal->save();
                            }
                        }
                    }
                }
                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addMonth(3)->addDay()->toDateString()) {
                    $deal->notification_status = 0;
                }
            } elseif ($deal->payment_method == 'inst_6') {
                $now = Carbon::now();
                // dd($deal->title ,'here!', $now->toDateString() == Carbon::make($deal->confirm_time)->addMonths(6)->toDateString(), $deal->confirm_time);
                // dd('here');
                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addMonths(6)->toDateString()) {
                    // dd('here');
                    if ($deal->notification_status == 0) {
                        foreach ($users as $user) {
                            if ($user->hasGroup('admin')) {
                                $deal->notification_status = 1;
                                $user->notify(new InstallmentDueToday($deal));
                                $deal->save();
                            }
                        }
                    }
                }
                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addMonth(6)->addDay()->toDateString()) {
                    $deal->notification_status = 0;
                }
            } elseif ($deal->payment_method == 'inst_12') {
                $now = Carbon::now();
                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addYear()->toDateString()) {
                    if ($deal->notification_status == 0) {
                        foreach ($users as $user) {
                            if ($user->hasGroup('admin')) {
                                $deal->notification_status = 1;
                                $user->notify(new InstallmentDueToday($deal));
                                $deal->save();
                            }
                        }
                    }
                }
                if ($now->toDateString() == Carbon::make($deal->confirm_time)->addYear()->addDay()->toDateString()) {
                    $deal->notification_status = 0;
                }
            }
        }

        return view('pages.dashboard-modern', [
            'balance' => $balance,
            'shortBalance' => $short_balance,
            'contacts' => $contacts->count(),
            'newContacts' => $new_contacts,
            'latest_deals' => $latest_deals,
            'latest_contacts' => $latest_contacts,
            'last_deal_value' => $last_deal_value->value ?? 0,
            'today_deals' => $today_deals ? $today_deals->sum('value') : 0,
            'today_deals_count' => $today_deals_count == 0 ? 1 : $today_deals_count,
        ]);
    }

    public function dashboardEcommerce()
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];

        return view('/pages/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }

    public function dashboardAnalytics()
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];

        return view('/pages/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
    }
}
