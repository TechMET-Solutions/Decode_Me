<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Workshop;
use App\Models\WorkshopDate;
use Illuminate\Http\Request;

class WorkshopDateController extends Controller
{

    public function index()
    {
    }


    public function create()
    {
        $expert = Expert::get();
        $workshop = Workshop::get();
        return view('admin.workshopdate.add', compact('expert', 'workshop'));
    }


    public function store(Request $request)
    {
        $workshopdate = new WorkshopDate;
        $workshopdate->date = $request->date;
        $workshopdate->start_time = $request->start_time;
        $workshopdate->end_time = $request->end_time;
        $workshopdate->venue = $request->venue;
        $workshopdate->seats = $request->seats;
        $workshopdate->expert = $request->expert;
        $workshopdate->desc = $request->desc;
        $workshopdate->workshop_id = $request->workshop_id;
        $workshopdate->save();
        return redirect()->route('admin.workshop')->with('success', 'Data Added Successfully!!!!');
    }


    public function show(WorkshopDate $workshopDate)
    {
        //
    }


    public function edit(WorkshopDate $workshopDate)
    {
        //
    }


    public function update(Request $request, WorkshopDate $workshopDate)
    {
        //
    }


    public function destroy(WorkshopDate $workshopDate)
    {
        //
    }
}
