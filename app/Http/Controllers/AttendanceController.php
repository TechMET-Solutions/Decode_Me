<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workshop;
use App\Models\Attendance;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use App\Models\StudentDetail;

class AttendanceController extends Controller
{
    public function attendancelist($id)
    {
        $workshop = Workshop::find($id);
        $school = SchoolDetail::where('status', '0')->get();
        //return $school;
        return view('admin.attendance.studattendanse', compact('workshop', 'school'));
    }

    public function showattendance($id, $wid, $date)
    {
        $attendance = Attendance::where('school_id', $id)->where('workshop_id', $wid)->where('date', $date)->first();
        // return $attendance;
        $school = SchoolDetail::get();
        $students = User::where('role', 'user')->get();
        return view('admin.attendance.showattendance', compact('attendance', 'school', 'students'));
    }

    public function index($id, $date)
    {
        // return $date;
        $students = User::where('role', 'user')->get();
        $attendance = Attendance::where('workshop_id', $id)->where('date', $date)->pluck('school_id')->toArray();
        // return $attendance;
        $school = SchoolDetail::whereNotIn('id', $attendance)->where('status', '0')->get();
        //return $school;
        $workshop = Workshop::where('id', $id)->whereDate('start_date', '<=', date('Y-m-d'))
            ->orWhereDate('end_date', '>=', date('Y-m-d'))
            ->first();
        // return $workshop;

        return view('admin.attendance.index', compact('students', 'workshop', 'school', 'date'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'school_id' => 'required',
            'attendance' => 'required',
        ]);
        $attendance = new Attendance;
        $attendance->date = $request->date;
        $attendance->attendance = $request->attendance;
        $attendance->school_id = $request->school_id;
        $attendance->workshop_id = $request->workshop_id;
        $attendance->save();
        return redirect()->route('admin.workshop')->with('success', 'Attendance Conducted Successfully!!!!');
    }

    public function editAttendance($id)
    {
        $attendance = Attendance::with('school', 'workshop')->find($id);
        //  $attendance->attendance = json_decode($attendance->attendance, true);
        if ($attendance) {
            $attendance->school_name = $attendance->school->school_name;
            $attendance->workshop_name = $attendance->workshop->topic;
        }
        $students = User::where('role', 'user')->where('school_id', $attendance->school_id)->get();
        // return $attendance;
        return view('admin.attendance.editattendance', compact('attendance', 'students'));
    }
    public function updateAttendance(Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'attendance' => 'required',
        ]);
        $attendance = Attendance::find($id);
        // return $attendance;
        $attendance->date = $request->date;
        $attendance->attendance = $request->attendance;
        $attendance->school_id = $request->school_id;
        $attendance->workshop_id = $request->workshop_id;
        $attendance->save();

        return redirect()->route('admin.showattendance', ['id' => $request->school_id, 'wid' => $request->workshop_id, 'date' => $request->date])->with('success', 'Attendance updated successfully');
    }
}
