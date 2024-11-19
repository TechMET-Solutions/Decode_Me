<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Expert;
use App\Models\Workshop;
use App\Models\GroupTask;
use App\Models\SubCareer;
use App\Models\Attendance;
use App\Models\StudentTask;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Imports\StudentImport;
use App\Models\IndividualTask;
use App\Models\StudentProfile;
use App\Models\StudentSession;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentCareerOption;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentDetailController extends Controller
{

    public function studentList(Request $request, $latest = null)
    {
        $school_id = $request->query('school_id');
        if ($latest == null) {
            if ($school_id) {
                $studentDetail = User::where('school_id', $school_id)->orderBy('id', 'DESC')->where('role', 'user')->paginate(10);
            } else {

                $studentDetail = User::where('role', 'user')->orderBy('id', 'DESC')->paginate(10);
                // return $studentDetail;
            }

            $expert = Expert::orderBy('name', 'ASC')->get();
            $schools = SchoolDetail::get();
            // $school = SchoolDetail::where('status', '0')->get();
        } else {
            $studentDetail = User::orderBy('id', 'ASC')->where('role', 'user')->get();
            $expert = Expert::orderBy('name', 'ASC')->get();
            $schools = SchoolDetail::get();
        }

        $students = StudentProfile::with('student')->get();
        $students->map(function ($stud) {
            $stud->stud_name = $stud->student->name;
            $stud->fatherOccupation = $stud->student->fatherOccupation;
            $stud->motherOccupation = $stud->student->motherOccupation;
            return $stud;
        });

        return view('admin.studentDetails.studentList', compact('studentDetail', 'expert', 'schools', 'students'));
    }


    public function addStudent()
    {
        $school = SchoolDetail::get();
        return view('admin.studentDetails.addStudent', compact('school'));
    }

    public function importExcel(Request $request)
    {
        // return $request->all();
        $schoolId = $request->schoolId;
        $request->validate([
            'import_file' => [
                'required',
                'file',
                'mimes:xls,xlsx'
            ]
        ]);

        Excel::import(new StudentImport($schoolId), $request->file('import_file'));

        return redirect()->route('admin.studentlist')->with('success', ' Students Data Imported Successfully!!!!');
    }

    public function studentListPDF(Request $request)
    {
        // return $request->all();
        $selectedSchoolId = $request->input('school_id');
        // return  $selectedSchoolId;
        if ($selectedSchoolId) {
            $students = User::where('school_id', $selectedSchoolId)->where('role', 'user')->get();
            $school = SchoolDetail::where('id', $selectedSchoolId)->first();
            $schoolName = $school->school_name;
        } else {
            $students = User::with('school')->where('role', 'user')->get();
            // return $students;
            $students->map(function ($stud) {
                $stud->school_name = $stud->school->school_name ?? '';
                return $stud;
            });
            $schoolName = '';
        }

        $data = [
            'title' => 'Students List',
            'date' => date('d/m/Y'),
            'schoolname' => $schoolName,
            'students' => $students
        ];

        // dd($data);
        $pdf = Pdf::loadView('admin.studentDetails.studentsPDF', $data); // Use the facade here
        return $pdf->download('StudentList.pdf');
    }


    public function storestudent(Request $request)
    {
        // return $request->all();
        $user = new User;
        $user->name = $request->stud_name;
        $user->email = $request->stud_email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->stud_phone;

        if ($request->hasFile('stud_image')) {
            $imageName = time() . '.' . $request->stud_image->extension();
            $request->stud_image->move('stud_images', $imageName);
        } else {
            $imageName = '';
        }
        $user->profile = $imageName;
        $user->dob = $request->stud_dob;
        $user->enrollDate = $request->date_of_en;
        $user->std = $request->stud_grade;
        $user->motherName = $request->mother_name;
        $user->motherPhone = $request->mother_phone;
        $user->motherOccupation = $request->mother_occupation;
        $user->fatherName = $request->father_name;
        $user->fatherPhone = $request->father_phone;
        $user->fatherOccupation = $request->father_occupation;
        $user->bank_holder_name = $request->bank_holder_name;
        $user->bank_name = $request->bank_name;
        $user->bank_acc_no = $request->bank_acc_no;
        $user->school_id = $request->school_id;

        if ($request->hasFile('aadhaar_card')) {
            $aadhaar_card = time() + 1 . '.' . $request->aadhaar_card->extension();
            $request->aadhaar_card->move('stud_images', $aadhaar_card);
        } else {
            $aadhaar_card = '';
        }
        $user->aadhaar = $aadhaar_card;

        if ($request->hasFile('pan_card')) {
            $pan_card = time() + 2 . '.' . $request->pan_card->extension();
            // return $imageName;
            $request->pan_card->move('stud_images', $pan_card);
        } else {
            $pan_card = '';
        }
        $user->pan = $pan_card;
        $user->save();

        return redirect()->route('admin.studentlist')->with('success', 'Data Added Successfully!!!!');
    }


    public function storeExpertInStudent(Request $request)
    {
        //return $request->all();
        $studentDetail = User::find($request->stud_id);
        $studentDetail->expert = $request->expert;
        $studentDetail->save();
        return redirect()->route('admin.studentlist')->with('success', 'Expert Assign Successfully!!!!');
    }


    public function showStudent(StudentDetail $studentDetail, $id)
    {
        $currentDate = Carbon::now();
        $studentDetail = User::find($id);
        $school = SchoolDetail::find($studentDetail->school_id);
        $workshops = Workshop::where('status', '0')->where('start_date', '>', $currentDate)->get();
        // return $workshops;
        $prevWorkshops = Workshop::with('attendance')->where('status', '1')->where('end_date', '<', $currentDate)->get();

        $upcomingTask = IndividualTask::with('task')->where('studId', $id)->where('status', '0')->where('deadlineDate', '>', $currentDate)->get();
        $upcomingTask->map(function ($tsk) {
            $tsk->task_name = $tsk->task->name;
            return $tsk;
        });

        $previousTask = IndividualTask::with('task')->where('studId', $id)->where('status', '4')->where('deadlineDate', '<', $currentDate)->get();
        $previousTask->map(function ($tsk) {
            $tsk->task_name = $tsk->task->name;
            return $tsk;
        });

        // return $upcomingTask;
        // dd($previousTask);

        return view('admin.studentDetails.showStudent', compact('studentDetail', 'school', 'workshops', 'prevWorkshops', 'upcomingTask', 'previousTask'));
    }


    public function editStudent(StudentDetail $studentDetail, $id)
    {
        $studentDetail = User::find($id);
        $school = SchoolDetail::get();
        return view('admin.studentDetails.editstudent', compact('studentDetail', 'school'));
    }


    public function updateStudent(Request $request, StudentDetail $studentDetail)
    {
        // return $request->all();
        $user = User::find($request->id);
        $user->name = $request->stud_name;
        if ($request->hasFile('stud_image')) {
            $imageName = time() . '.' . $request->stud_image->extension();
            $request->stud_image->move('stud_images', $imageName);
            $filePath = public_path('stud_images/' . $user->profile);
            if (is_file($filePath)) {
                unlink($filePath);
            }
            $user->profile = $imageName;
        }
        $user->dob = $request->stud_dob;
        // $user->password = Hash::make($request->password);
        $user->mobile = $request->stud_phone;
        $user->email = $request->stud_email;
        $user->enrollDate = $request->date_of_en;
        $user->school_id = $request->school_id;
        $user->std = $request->stud_grade;
        $user->motherName = $request->mother_name;
        $user->motherPhone = $request->mother_phone;
        $user->motherOccupation = $request->mother_occupation;
        $user->fatherName = $request->father_name;
        $user->fatherPhone = $request->father_phone;
        $user->fatherOccupation = $request->father_occupation;
        $user->bank_holder_name = $request->bank_holder_name;
        $user->bank_name = $request->bank_name;
        $user->bank_acc_no = $request->bank_acc_no;
        if ($request->hasFile('aadhaar_card')) {
            $aadhaar_card = time() + 1 . '.' . $request->aadhaar_card->extension();
            $request->aadhaar_card->move('stud_images', $aadhaar_card);
            $filePath = public_path('stud_images/' . $user->aadhaar);
            if (is_file($filePath)) {
                unlink($filePath);
            }
            $user->aadhaar = $aadhaar_card;
        }
        if ($request->hasFile('pan_card')) {
            $pan_card = time() + 2 . '.' . $request->pan_card->extension();
            $request->pan_card->move('stud_images', $pan_card);
            $filePath = public_path('stud_images/' . $user->pan);
            if (is_file($filePath)) {
                unlink($filePath);
            }
            $user->pan = $pan_card;
        }
        $user->save();
        return redirect()->route('admin.studentlist')->with('success', 'Data Updated Successfully!!!!');
    }


    public function destroy(StudentDetail $studentDetail)
    {
        //
    }
    public function studentReport($id)
    {
        $stud = User::find($id);
        //return $stud;
        $stud_id = $stud->id;
        $stud_name = $stud->name;
        $school_name = $stud->school->school_name;
        // return  $school_name;
        $stud_grade = $stud->std;
        $stud_schoolid = $stud->school_id;
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
        $pdf = Pdf::loadView('admin.studentDetails.studentReportPDF', $data);
        return $pdf->download('StudentReport.pdf');
    }

    public function studtaskReport($id)
    {
        $stud = User::find($id);
        //return $stud;
        $stud_id = $stud->id;
        $stud_name = $stud->name;
        $school_name = $stud->school->school_name;
        // return  $school_name;
        $stud_grade = $stud->std;
        // $stud_schoolid = $stud->school_id;
        $task = IndividualTask::where('studId', $id)->get();
        if ($task->isNotEmpty()) {
            $taskdata = [
                'title' => 'Student Task Report.',
                'stud_name' => $stud_name,
                'school_name' => $school_name,
                'stud_grade' => $stud_grade,
                'task' => $task,
            ];
            $pdf = Pdf::loadView('admin.studentDetails.studentTaskPDF', $taskdata);
            return $pdf->download('StudentTaskReport.pdf');
        } else {
            return back()->with('success', 'Not Assigned any task!!!!!');
        }
    }
}
