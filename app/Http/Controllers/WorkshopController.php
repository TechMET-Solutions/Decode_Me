<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Expert;
use App\Models\Workshop;
use App\Models\Attendance;
use App\Models\Notification;
use App\Models\SchoolDetail;
use App\Models\WorkshopDate;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{

    public function index()
    {
        $workshop = Workshop::get();
        foreach ($workshop as $ws) {
            if ($ws->end_date < date('Y-m-d')) {
                $wksp = Workshop::find($ws->id);
                $wksp->status = '1';
                $wksp->save();
            }
        }
        $schoolCount = SchoolDetail::where('status', '0')->count();
        // $attendance = Attendance::where('date', date('Y-m-d'))->get();
        // return $workshop;
        $attendanceCount = Attendance::where('date', date('Y-m-d'))->count();
        return view('admin.workshop.index', compact('workshop', 'attendanceCount', 'schoolCount'));
    }


    public function addWorkshop()
    {
        $expert = Expert::orderBy('name', 'ASC')->get();
        return view('admin.workshop.addworkshop', compact('expert'));
    }


    public function storeWorkshop(Request $request)
    {
        $workshop = new Workshop;
        $workshop->topic = $request->topic;
        $workshop->start_date = $request->start_date;
        $workshop->start_time_start_date = $request->start_time_start_date;
        $workshop->end_time_start_date = $request->end_time_start_date;
        $workshop->end_date = $request->end_date;
        $workshop->start_time_end_date = $request->start_time_end_date;
        $workshop->end_time_end_date = $request->end_time_end_date;
        $workshop->venue = $request->venue;
        $workshop->seats = $request->seats;
        $workshop->expert = json_encode($request->experts);
        $workshop->desc = $request->desc;
        $workshop->save();

        $descText = strip_tags($request->desc);
        $title = $request->topic . ' Workshop is scheduled';
        // $desc = '';
        $desc = $descText;
        $users = User::where('role', 'user')->get();
        foreach ($users as $user) {
            Notification::create(['studId' => $user->id, 'title' => $title, 'description' => $desc]);
        }

        return redirect()->route('admin.workshop')->with('success', 'Data Added Successfully!!!!');
    }


    public function edit(Workshop $workshop, $id)
    {
        $workshop = Workshop::find($id);
        // return $workshop;
        $expert = Expert::orderBy('name', 'ASC')->get();
        // return $expert;

        return view('admin.workshop.edit', compact('workshop', 'expert'));
    }


    public function update(Request $request, Workshop $workshop, $id)
    {
        $workshop = Workshop::find($id);
        $workshop->topic = $request->topic;
        $workshop->start_date = $request->start_date;
        $workshop->start_time_start_date = $request->start_time_start_date;
        $workshop->end_time_start_date = $request->end_time_start_date;
        $workshop->end_date = $request->end_date;
        $workshop->start_time_end_date = $request->start_time_end_date;
        $workshop->end_time_end_date = $request->end_time_end_date;
        $workshop->venue = $request->venue;
        $workshop->seats = $request->seats;
        $workshop->expert = json_encode($request->experts);
        $workshop->desc = $request->desc;
        $workshop->save();
        return redirect()->route('admin.workshop')->with('success', 'Data Updated Successfully!!!!');
    }


    public function delete(Workshop $workshop, $id)
    {
        $workshop = Workshop::find($id);
        $workshop->delete();
        return redirect()->route('admin.workshop')->with('success', 'Data Deleted Successfully!!!!');
    }
}
