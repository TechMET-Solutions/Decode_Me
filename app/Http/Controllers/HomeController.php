<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Expert;
use App\Models\Workshop;
use App\Models\DMSession;
use App\Models\GroupTask;
use App\Models\Internship;
use App\Models\Notification;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use App\Models\IndividualTask;
use App\Models\StudentCareerOption;
use App\Models\StudentSession;
use App\Models\SubCareer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // return $student;
        $stud_id = Auth::user()->id;
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        return view('home', compact('notifications'));
    }
    public function studentReport()
    {
        $stud_id = Auth::user()->id;
        $stud_name = Auth::user()->name;
        $school_name = Auth::user()->school->school_name;
        // return  $school_name;
        $stud_grade = Auth::user()->std;
        $stud_schoolid = Auth::user()->school_id;
        $attendance = Attendance::with('workshop')->get();
        $work = null;
        $day1att = false;
        $day2att = false;
        foreach ($attendance as $att) {
            $studattArray = json_decode($att->attendance, true) ?? [];
            if (in_array($stud_id, $studattArray)) {
                $work = Workshop::find($att->workshop_id);
                $attendday1 = Attendance::where('workshop_id', $work->id)
                    ->where('school_id', $stud_schoolid)
                    ->where('date', $work->start_date)
                    ->first();
                if ($attendday1) {
                    $day1 = json_decode($attendday1->attendance, true) ?? [];
                    if (in_array($stud_id, $day1)) {
                        $day1att = true;
                    }
                }

                $attendday2 = Attendance::where('workshop_id', $work->id)
                    ->where('date', $work->end_date)
                    ->where('school_id', $stud_schoolid)
                    ->first();
                if ($attendday2) {
                    $day2 = json_decode($attendday2->attendance, true) ?? [];
                    if (in_array($stud_id, $day2)) {
                        $day2att = true;
                    }
                }
                break;
            }
        }

        $inditask = IndividualTask::where('studId', $stud_id)->count();
        $pinditask = IndividualTask::where('studId', $stud_id)->where('status', '0')->count();
        $sinditask = IndividualTask::where('studId', $stud_id)->where('status', '1')->count();
        $oinditask = IndividualTask::where('studId', $stud_id)->where('status', '3')->count();
        $cinditask = IndividualTask::where('studId', $stud_id)->where('status', '4')->count();
        $rsinditask = IndividualTask::where('studId', $stud_id)->where('status', '2')->count();
        $grtask = GroupTask::count();
        $pgrtask = GroupTask::where('status', '0')->count();
        $ogrtask = GroupTask::where('status', '3')->count();
        $cgrtask = GroupTask::where('status', '4')->count();
        $sgrtask = GroupTask::where('status', '1')->count();
        $totdmsession = StudentSession::where('studId', $stud_id)->count();
        $dmsession = StudentSession::where('studId', $stud_id)->where('status', '0')->orWhere('status', '1')->count();
        $comdmsession = StudentSession::where('studId', $stud_id)->where('status', '2')->count();
        $candmsession = StudentSession::where('studId', $stud_id)->where('status', '3')->count();
        $sco = StudentCareerOption::where('stud_id', $stud_id)->latest()->first();
        $subcareer = SubCareer::with('career')->get();
        $subcareer->map(function ($subCareer) {
            $subCareer->career_name = $subCareer->career->name;
            return $subCareer;
        });
        // return $subcareer;
        $data = [
            'title' => 'Report Card',
            'stud_name' => $stud_name,
            'school_name' => $school_name,
            'stud_grade' => $stud_grade,
            'workshop' => $work ? $work->topic : null,
            'w_s_d' => $work ? $work->start_date : null,
            'w_e_d' => $work ? $work->end_date : null,
            'day1att' => $day1att,
            'day2att' => $day2att,
            'inditask' => $inditask,
            'pinditask' => $pinditask,
            'sinditask' => $sinditask,
            'oinditask' => $oinditask,
            'cinditask' => $cinditask,
            'rsinditask' => $rsinditask,
            'grtask' => $grtask,
            'pgrtask' => $pgrtask,
            'ogrtask' => $ogrtask,
            'cgrtask' => $cgrtask,
            'sgrtask' => $sgrtask,
            'totdmsession' => $totdmsession,
            'dmsession' => $dmsession,
            'comdmsession' => $comdmsession,
            'candmsession' => $candmsession,
            'sco' => $sco,
            'subcareer' => $subcareer,
        ];
        $pdf = Pdf::loadView('user.reportPDF', $data);
        return $pdf->download('StudentReport.pdf');
    }
    public function adminHome()
    {
        $expert  = Expert::count();
        $student = User::where('role', 'user')->count();
        $school = SchoolDetail::count();
        $inditask = IndividualTask::count();
        $pinditask = IndividualTask::where('status', '0')->count();
        $sinditask = IndividualTask::where('status', '1')->count();
        $oinditask = IndividualTask::where('status', '3')->count();
        $cinditask = IndividualTask::where('status', '4')->count();

        $grtask = GroupTask::count();
        $pgrtask = GroupTask::where('status', '0')->count();
        $ogrtask = GroupTask::where('status', '3')->count();
        $cgrtask = GroupTask::where('status', '4')->count();
        $sgrtask = GroupTask::where('status', '1')->count();

        $internship = Internship::count();
        $dmsession = StudentSession::where('status', '0')->orWhere('status', '1')->count();
        $comdmsession = StudentSession::where('status', '2')->count();
        $workshop = Workshop::where('end_date', '<', date('Y-m-d'))->count();
        return view('admin/home', compact('expert', 'student', 'school', 'inditask', 'grtask', 'internship', 'workshop', 'pinditask', 'oinditask', 'sinditask', 'cinditask', 'pgrtask', 'ogrtask', 'cgrtask', 'sgrtask', 'dmsession', 'comdmsession'));
    }

    public function analyticsPDF()
    {

        $school = SchoolDetail::where('status', '0')->count();
        $student = User::where('role', 'user')->count();
        $expert  = Expert::count();
        $inditask = IndividualTask::count();
        $pinditask = IndividualTask::where('status', '0')->count();
        $sinditask = IndividualTask::where('status', '1')->count();
        $oinditask = IndividualTask::where('status', '3')->count();
        $cinditask = IndividualTask::where('status', '4')->count();
        $grtask = GroupTask::count();
        $pgrtask = GroupTask::where('status', '0')->count();
        $ogrtask = GroupTask::where('status', '3')->count();
        $cgrtask = GroupTask::where('status', '4')->count();
        $sgrtask = GroupTask::where('status', '1')->count();
        $totdmsession = StudentSession::count();
        $dmsession = StudentSession::where('status', '0')->orWhere('status', '1')->count();
        $comdmsession = StudentSession::where('status', '2')->count();
        $candmsession = StudentSession::where('status', '3')->count();
        $workshop = Workshop::where('end_date', '<', date('Y-m-d'))->count();
        $internship = Internship::count();
        $data = [
            'title' => 'DecodingMe Analytics',
            'date' => date('d/m/Y'),
            'school' => $school,
            'student' => $student,
            'expert' => $expert,
            'inditask' => $inditask,
            'pinditask' => $pinditask,
            'sinditask' => $sinditask,
            'oinditask' => $oinditask,
            'cinditask' => $cinditask,
            'grtask' => $grtask,
            'pgrtask' => $pgrtask,
            'ogrtask' => $ogrtask,
            'cgrtask' => $cgrtask,
            'sgrtask' => $sgrtask,
            'internship' => $internship,
            'totdmsession' => $totdmsession,
            'dmsession' => $dmsession,
            'comdmsession' => $comdmsession,
            'candmsession' => $candmsession,
            'workshop' => $workshop,
            'internship' => $internship,
        ];
        $pdf = Pdf::loadView('admin.analyticsPDF', $data);
        return $pdf->download('Anatytics.pdf');
    }
}
