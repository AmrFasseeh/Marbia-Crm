<?php

namespace App\Http\Controllers;

use App\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $first = Carbon::now()->firstOfMonth()->toDateTimeString();
            $last = Carbon::now()->lastOfMonth()->toDateTimeString();
            // dd($today);
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : $first;
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : $last;

            $data = Calendar::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['title', 'start', 'end']);
            // dd($data);
            // $response = [
            //     'id' => 1,
            //     'title' => 'anything',
            //     'start' => $start,
            //     'end' => $last,
            // ];
            // $send = json_encode($response);
            // dd(response()->json($data));
            return response()->json($data);
        }
        // Breadcrumbs
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "App"], ['name' => "Calendar"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.calendar.app-calendar', ['breadcrumbs' => $breadcrumbs], ['pageConfigs' => $pageConfigs]);
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
        if (request()->ajax()) {
            $user = Auth::user();
            $user->events()->create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                'description' => $request->description,
                'color' => $request->color,
            ]);
            // $event = Calendar::insert($insertArr);
            // dd($event);
            return response()->json($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        //
    }
}
