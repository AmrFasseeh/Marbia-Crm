<?php

namespace App\Http\Controllers;

use App\LeadStage;
use Illuminate\Http\Request;

class LeadStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(LeadStage::all()->count() == null){
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadStage  $leadStage
     * @return \Illuminate\Http\Response
     */
    public function show(LeadStage $leadStage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadStage  $leadStage
     * @return \Illuminate\Http\Response
     */
    public function edit(LeadStage $leadStage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadStage  $leadStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeadStage $leadStage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadStage  $leadStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadStage $leadStage)
    {
        //
    }
}
