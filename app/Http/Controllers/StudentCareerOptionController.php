<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Career;
use App\Models\SubCareer;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Mail\CareerInterestMail;
use App\Models\SchoolDetail;
use App\Models\StudentCareerOption;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentCareerOptionController extends Controller
{

    public function index($id)
    {
        $career = Career::get();
        $subcareer = SubCareer::get();
        $student = User::find($id);
        $scop = StudentCareerOption::where('stud_id', $student->id)->latest()->first() ?? '';
        // return $scop;
        return view('admin.studentcareeroption.index', compact('career', 'subcareer', 'student', 'scop'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $studentCareerOption = new StudentCareerOption;
        $studentCareerOption->date = $request->date;
        $studentCareerOption->stud_id = $request->stud_id;
        $studentCareerOption->sc_priority = $request->sc_priority;
        $studentCareerOption->save();

        $student = User::find($request->stud_id);
        $careerInterestData = [
            'stud_name' => $student->name,
        ];
        //  Mail::to($student->email)->send(new CareerInterestMail($careerInterestData));
        try {
            Mail::to($student->email)->send(new CareerInterestMail($careerInterestData));
        } catch (\Exception $e) {
            Log::error('Failed to send email to ' . $student->email . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }

        return redirect()->route('admin.studentlist')->with('success', 'Rank Set Successfully to Student!!!!');
    }

    public function scohistory($id)
    {
        $career = Career::get();
        $subcareer = SubCareer::get();
        $student = User::find($id);
        $studcop = StudentCareerOption::where('stud_id', $student->id)->get();
        return view('admin.studentcareeroption.history', compact('career', 'subcareer', 'student', 'studcop'));
    }

    public function studentCareerRankPDF($id, $sid)
    {
        $student = user::find($id);
        $school = SchoolDetail::find($sid);
        $careerrank = StudentCareerOption::where('stud_id', $student->id)->latest()->first();
        // return $careerrank;
        $subCareer = SubCareer::with('career')->get();
        $subCareer->map(function ($subCareer) {
            $subCareer->career_name = $subCareer->career->name;
            return $subCareer;
        });
        if ($careerrank !== null) {
            $data = [
                'title' => 'Student Career Ranks',
                'date' => date('d/m/Y'),
                'name' => $student->name,
                'sname' => $school->school_name,
                'careerrank' => $careerrank,
                'subCareer' => $subCareer,
            ];
            $pdf = Pdf::loadView('admin.studentcareeroption.careerRankPDF', $data);
            return $pdf->download('StudentCareerRank.pdf');
        } else {
            return redirect()->back()->with('failed', 'Unable to download PDF because there is no Career Rank in database');
        }
    }
}
