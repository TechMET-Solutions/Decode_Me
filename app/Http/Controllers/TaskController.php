<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\GroupTask;
use App\Models\StudentTask;
use App\Models\Notification;
use App\Models\ScheduleTask;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\IndividualTask;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\AssignIndiTaskMail;
use App\Models\StudentGroupTask;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookSessionRemainderMail;

class TaskController extends Controller
{

    public function previousTaskList()
    {
        $individual = IndividualTask::with('student', 'task', 'school')->get();
        // $individual = IndividualTask::with('student', 'task', 'school')->where('deadlineDate', date('Y-m-d'))->get();
        $individual->map(function ($indi) {
            $indi->stud_id = $indi->student->id;
            $indi->stud_name = $indi->student->name;
            $indi->taskId = $indi->task->id;
            $indi->task_name = $indi->task->name;
            $indi->task_questions = $indi->task->desc;
            $indi->school_name = $indi->school->school_name;
            return $indi;
        });

        foreach ($individual as $indi) {
            if ($indi->deadlineDate < date('Y-m-d')) {
                if ($indi->status == '0') {
                    $indiv = IndividualTask::find($indi->id);
                    $indiv->status = '3';
                    $indiv->save();
                }
            }
        }

        $submitedTask = StudentTask::get();
        $groupTasks = StudentGroupTask::get();
        // return $submitedTask;
        $students = User::where('role', 'user')->get();
        $group = GroupTask::with('task', 'school')->latest()->get();
        // $group = GroupTask::with('task', 'school')->where('deadlineDate', date('Y-m-d'))
        //     ->get();
        $group->map(function ($grp) {
            $grp->taskId = $grp->task->id;
            $grp->task_name = $grp->task->name;
            $grp->task_questions = $grp->task->desc;
            $grp->school_name = $grp->school->school_name;
            return $grp;
        });

        foreach ($group as $grp) {
            if ($grp->deadlineDate < date('Y-m-d')) {
                $grup = GroupTask::find($grp->id);
                $grup->status = '3';
                $grup->save();
            }
        }
        // return $individual;
        return view('admin.task.previousTask', compact('individual', 'group', 'students', 'submitedTask', 'groupTasks'));
    }

    public function index()
    {
        $task = Task::get();
        $intask = Task::where('type', 'Individual')->get();
        $grtask = Task::where('type', 'Group')->get();
        // return $intask;
        $school = SchoolDetail::get();
        $sch = SchoolDetail::get();
        $stud = User::where('role', 'user')->get();
        $student = User::where('role', 'user')->get();
        // return $student;
        return view('admin.task.index', compact('task', 'stud', 'intask', 'grtask', 'student', 'school', 'sch'));
    }


    public function create()
    {

        return view('admin.task.add');
    }


    public function store(Request $request)
    {
        // return $request->all();
        $task = new Task;
        $task->name = $request->name;
        $task->type = $request->type;
        $task->desc = $request->desc;
        $task->save();
        return redirect()->route('admin.taskList')->with('success', 'Data Added Successfully!!!!');
    }

    public function storeIndividualTask(Request $request)
    {
        $intask = new IndividualTask;
        $intask->taskID = $request->taskID;
        $intask->studId = $request->studId;
        $intask->schoolId = $request->schoolId;
        $intask->deadlineDate = $request->deadlineDate;
        $intask->deadlineTime = $request->deadlineTime;
        $intask->desc = $request->desc;
        $intask->save();

        $student = User::find($request->studId);
        $indiTaskData = [
            'stud_name' => $student->name,
        ];
        // Mail::to($student->email)->send(new AssignIndiTaskMail($indiTaskData));
        try {
            Mail::to($student->email)->send(new AssignIndiTaskMail($indiTaskData));
        } catch (\Exception $e) {
            Log::error('Failed to send email to ' . $student->email . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }


        $descText = strip_tags($request->desc);
        $title = 'Task is Pending';
        $desc = $descText;
        $users = User::where('role', 'user')->find($request->studId);
        Notification::create(['studId' => $users->id, 'title' => $title, 'description' => $desc]);

        return redirect()->route('admin.taskList')->with('success', 'Data Added Successfully!!!!');
    }

    public function storeGroupTask(Request $request)
    {
        // return $request->all();
        $grtask = new GroupTask;
        $grtask->taskID = $request->taskID;
        $grtask->schoolId = $request->school_Id;
        $grtask->studIds = json_encode($request->studIds);
        $grtask->deadlineDate = $request->deadlineDate;
        $grtask->deadlineTime = $request->deadlineTime;
        $grtask->desc = $request->desc;
        $grtask->save();
        return redirect()->route('admin.taskList')->with('success', 'Data Added Successfully!!!!');
    }

    public function update(Task $task, Request $request)
    {
        $task = Task::find($request->id);
        $task->name = $request->name;
        $task->type = $request->type;
        $task->desc = $request->desc;
        $task->save();
        return redirect()->route('admin.taskList')->with('success', 'Data Updated Successfully!!!!');
    }


    public function delete(Task $task, $id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('admin.taskList')->with('success', 'Data Deleted Successfully!!!!');
    }

    public function taskApproval(Request $request)
    {
        // return $request->all();
        $individual = IndividualTask::where('studId', $request->stud_id)->where('taskID', $request->task_id)->where('schoolId', $request->school_id)->first();
        if ($request->status == 'approve') {
            // return "Approve";
            $individual->status = '4';
            $individual->reason = null;
            $individual->save();

            $student = User::find($request->stud_id);
            $bookSessionRemainderData = [
                'stud_name' => $student->name,
            ];
            // Mail::to($student->email)->send(new BookSessionRemainderMail($bookSessionRemainderData));
            try {
                Mail::to($student->email)->send(new BookSessionRemainderMail($bookSessionRemainderData));
            } catch (\Exception $e) {
                Log::error('Failed to send email to ' . $student->email . ': ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
            }
        } else {
            // return "Disapprove";
            $individual->status = '2';
            $individual->reason = $request->reason;
            $individual->save();

            // $schedule = ScheduleTask::where('studId', $request->stud_id)->where('taskID', $request->task_id)->where('schoolId', $request->school_id)->latest()->first();
            // $schedule->status = '0';
            // $schedule->save();

            $title = 'Task is Resubmit';
            $desc = 'Please resubmit your task. Your task was not approved by the admin.';
            $users = User::where('role', 'user')->find($request->stud_id);
            Notification::create(['studId' => $users->id, 'title' => $title, 'description' => $desc]);
        }
        // return $individual;
        return redirect()->back()->with('success', 'Status change successfully');
    }

    public function taskGroupApproval(Request $request)
    {

        // return $request->all();
        $group = GroupTask::find($request->grp_indi_id);

        if ($request->status == 'approve') {
            // return "Approve";
            $group->status = '4';
            $group->reason = null;
            $group->save();
        } else {
            // return "Disapprove";
            $group->status = '2';
            $group->reason = $request->reason;
            $group->save();
        }

        return redirect()->back()->with('success', 'Status change successfully');
    }


    public function taskReport()
    {
        $task = IndividualTask::get();
        // $stud = User::where('role', 'user')->get();

        if ($task->isNotEmpty()) {
            $taskdata = [
                'title' => 'Students Task Report.',
                'task' => $task,
            ];
            $pdf = Pdf::loadView('admin.task.TaskReportPDF', $taskdata);
            return $pdf->download('StudentsTaskReport.pdf');
        } else {
            return back()->with('success', 'Not Assigned any task!!!!!');
        }
    }
}
