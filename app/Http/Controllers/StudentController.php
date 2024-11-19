<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\MOM;
use App\Models\Task;
use App\Models\User;
use App\Models\Career;
use App\Models\Expert;
use App\Models\AIPortal;
use App\Models\Feedback;
use App\Models\Workshop;
use App\Models\DMSession;
use App\Models\GroupTask;
use App\Models\SubCareer;
use App\Models\Attendance;
use App\Models\CareerClub;
use App\Models\Internship;
use App\Models\StudentTask;
use App\Models\Notification;
use App\Models\ScheduleTask;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use App\Mail\BookSessionMail;
use App\Models\ProgressVideo;
use App\Models\IndividualTask;
use App\Models\InternTakeaway;
use App\Models\ScheduleExpert;
use App\Models\StudentProfile;
use App\Models\StudentSession;
use App\Models\StudentGroupTask;
use App\Models\ScheduleGroupTask;
use App\Models\StudentCareerOption;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookSessionMailToExpert;

class StudentController extends Controller
{
    public function workshop()
    {
        $stud_id = Auth::user()->id;
        $currentDate = Carbon::now();
        $workshops = Workshop::where('status', '0')->get();
        $prevWorkshops = Workshop::where('status', '1')->get();
        $feedback = Feedback::where('studId', $stud_id)->first();
        $scheduleCall = ScheduleExpert::where('studId', $stud_id)->first();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        return view('user.workshop', compact('workshops', 'prevWorkshops', 'feedback', 'scheduleCall', 'notifications'));
    }

    public function pastWorkshop($id)
    {
        $stud_id = Auth::user()->id;
        $feedback = Feedback::where('studId', $stud_id)->first();
        // return $feedback;
        $scheduleCall = ScheduleExpert::where('studId', $stud_id)->first();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        $workshop = Workshop::find($id);
        return view('user.pastWorkshop', compact('workshop', 'feedback', 'scheduleCall', 'notifications'));
    }

    public function expertNames($id)
    {
        $stud_id = Auth::user()->id;
        $workshop = Workshop::find($id);
        // return $workshop;
        $expertNames = json_decode($workshop->expert, true);
        $experts = Expert::whereIn('name', $expertNames)->get();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        // return $experts;
        return view('user.expertNames', compact('experts', 'notifications'));
    }

    public function expertDetails($id)
    {
        $stud_id = Auth::user()->id;
        $expert = Expert::find($id);
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        return view('user.expertDetails', compact('expert', 'notifications'));
    }

    public function counselling()
    {
        $id = Auth::user()->id;
        $bookedSession = StudentSession::get();
        $dmSession = DMSession::with('studSession')->where('date', '>=', date('Y-m-d'))->where('mode', 'Online')->get();
        foreach ($dmSession as $dmData) {
            $timeSlots = json_decode($dmData->time, true);

            if ($dmData->studSession->isNotEmpty()) {
                $studSessionTimes = $dmData->studSession->pluck('time')->toArray();

                $availableTimeSlots = array_filter($timeSlots, function ($timeSlot) use ($studSessionTimes) {
                    return !in_array($timeSlot, $studSessionTimes);
                });

                $availableTimeSlots = array_values($availableTimeSlots);
            } else {
                $availableTimeSlots = $timeSlots;
            }

            $dmData->time_slots = json_encode($availableTimeSlots);
        }

        $ongoingSession = StudentSession::with('expert')
            ->where('date', '>=', date('Y-m-d'))
            ->where('studId', $id)
            ->where('mode', 'Online')
            ->where(function ($query) {
                $query->where('status', '0')
                    ->orWhere('status', '1');
            })
            ->get();
        $ongoingSession->map(function ($expe) {
            $expe->expert_name = $expe->expert->name;
            return $expe;
        });
        // return $ongoingSession;

        // return $dmSession;
        $previousSession = StudentSession::with('expert')->where('date', '=<', date('Y-m-d'))->where('studId', $id)->where('mode', 'Online')->where('status', '2')->get();
        $previousSession->map(function ($expe) {
            $expe->expert_name = $expe->expert->name;
            return $expe;
        });

        $completeSession = StudentSession::where('status', '2')->where('studId', $id)->where('mode', 'Online')->get();
        $completeSession->map(function ($expe) {
            $expe->expert_name = $expe->expert->name;
            return $expe;
        });
        //   return $completeSession;
        $cancelSession = StudentSession::where('status', '3')->where('studId', $id)->where('mode', 'Online')->get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.counselling', compact('dmSession', 'ongoingSession', 'previousSession', 'completeSession', 'notifications', 'feedback', 'cancelSession'));
    }

    // public function bookSession(Request $request)
    // {
    //     //return $request->all();
    //     if ($request->expert_id != null) {
    //         StudentSession::updateOrCreate(
    //             [
    //                 'studId' => $request->stud_id,
    //                 'ex_id' => $request->expert_id,
    //                 'dmsessionId' => $request->dmsessionId,
    //                 'date' => $request->date,
    //                 'mode' => $request->mode,
    //             ],
    //             [
    //                 'time' => $request->timeSlot,
    //                 'venue' => $request->venue,
    //             ]
    //         );

    //         $student = User::find($request->stud_id);
    //         $bookSessionMailData = [
    //             'stud_name' => $student->name,
    //             'date' => $request->date,
    //             'time' => $request->timeSlot,
    //         ];
    //         Mail::to($student->email)->send(new BookSessionMail($bookSessionMailData));
    //         $expert = Expert::find($request->expert_id);
    //         $bookSessionExpertData = [
    //             'stud_name' => $student->name,
    //             'date' => $request->date,
    //             'time' => $request->timeSlot,
    //         ];

    //         Mail::to($expert->email)->send(new BookSessionMailToExpert($bookSessionExpertData));

    //         return redirect()->back()->with('success', 'Session Booked Successfully..');
    //     }
    //     return redirect()->back()->with('failed', 'Select Date and timeslot');
    // }

    public function bookSession(Request $request)
    {
        //return $request->all();
        if ($request->timeSlot != null && $request->date != null) {
            // Create a new session record for each booking
            StudentSession::create([
                'studId' => $request->stud_id,
                'ex_id' => $request->expert_id,
                'dmsessionId' => $request->dmsessionId,
                'date' => $request->date,
                'mode' => $request->mode,
                'time' => $request->timeSlot,
                'venue' => $request->venue,
            ]);

            // Fetch student and expert information
            $student = User::find($request->stud_id);
            $expert = Expert::find($request->expert_id);

            // Prepare and send email to student
            $bookSessionMailData = [
                'stud_name' => $student->name,
                'date' => $request->date,
                'time' => $request->timeSlot,
            ];
            // Mail::to($student->email)->send(new BookSessionMail($bookSessionMailData));
            try {
                Mail::to($student->email)->send(new BookSessionMail($bookSessionMailData));
            } catch (\Exception $e) {
                Log::error('Failed to send email to ' . $student->email . ': ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
            }

            // Prepare and send email to expert
            $bookSessionExpertData = [
                'stud_name' => $student->name,
                'date' => $request->date,
                'time' => $request->timeSlot,
            ];
            //  Mail::to($expert->email)->send(new BookSessionMailToExpert($bookSessionExpertData));
            try {
                Mail::to($expert->email)->send(new BookSessionMailToExpert($bookSessionExpertData));
            } catch (\Exception $e) {
                Log::error('Failed to send email to ' . $expert->email . ': ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
            }


            return redirect()->back()->with('success', 'Session booked successfully.');
        }

        return redirect()->back()->with('failed', 'Select date and timeslot.');
    }



    public function scheduleExpertCall(Request $request)
    {
        // return $request->all();
        $scheduleCall = new ScheduleExpert;
        $scheduleCall->studId = $request->stud_id;
        $scheduleCall->schoolId = $request->school_id;
        $scheduleCall->expert = $request->expert;
        $scheduleCall->scheduleDate = $request->scheduleDate;
        $scheduleCall->scheduleTime = $request->scheduleTime;
        $scheduleCall->status = '1';
        $scheduleCall->save();

        return redirect()->back()->with('success', 'Successfully schedule call');
    }

    public function sessionCompleted($id)
    {
        // return "test";
        $sid = Auth::user()->id;
        $completeSession = StudentSession::where('status', '2')->where('id', $id)->where('studId', $sid)->first();
        if ($completeSession) {
            $completeSession->expert_name = $completeSession->expert->name;
        }
        //return $completeSession;
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.sessionComplete', compact('notifications', 'completeSession'));
    }

    public function counsellingOffline()
    {
        $id = Auth::user()->id;
        $bookedSession = StudentSession::where('mode', 'Offline')->where('date', '>=', date('Y-m-d'))->get();
        //return $bookedSession;
        $dmSession = DMSession::with('studSession')->where('date', '>=', date('Y-m-d'))->where('mode', 'Offline')->get();
        // foreach ($dmSession as $dmData) {
        //     $timeSlots = json_decode($dmData->time, true);

        //     if ($dmData->studSession->isNotEmpty()) {
        //         $studSessionTimes = $dmData->studSession->pluck('time')->toArray();

        //         $availableTimeSlots = array_filter($timeSlots, function ($timeSlot) use ($studSessionTimes) {
        //             return !in_array($timeSlot, $studSessionTimes);
        //         });

        //         $availableTimeSlots = array_values($availableTimeSlots);
        //     } else {
        //         $availableTimeSlots = $timeSlots;
        //     }

        //     $dmData->time_slots = json_encode($availableTimeSlots);
        // }
        $ongoingSession = StudentSession::with('expert')
            ->where('date', '>=', date('Y-m-d'))
            ->where('studId', $id)
            ->where('mode', 'Offline')
            ->where(function ($query) {
                $query->where('status', '0')
                    ->orWhere('status', '1');
            })
            ->get();
        $ongoingSession->map(function ($expe) {
            $expe->expert_name = $expe->expert->name;
            return $expe;
        });
        //  return $ongoingSession;
        $previousSession = StudentSession::with('expert')->where('date', '=<', date('Y-m-d'))->where('studId', $id)->where('mode', 'Offline')->where('status', '2')->get();
        $previousSession->map(function ($expe) {
            $expe->expert_name = $expe->expert->name;
            return $expe;
        });
        //return $previousSession;
        $completeSession = StudentSession::with('expert')->where('status', '2')->where('studId', $id)->where('mode', 'Offline')->get();
        $completeSession->map(function ($expe) {
            $expe->expert_name = $expe->expert->name;
            return $expe;
        });
        $cancelSession = StudentSession::with('expert')->where('status', '3')->where('studId', $id)->where('mode', 'Offline')->get();
        $cancelSession->map(function ($expe) {
            $expe->expert_name = $expe->expert->name;
            return $expe;
        });
        // return $cancelSession;
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.counsellingOffline', compact('dmSession', 'ongoingSession', 'previousSession', 'completeSession', 'notifications', 'feedback', 'cancelSession', 'bookedSession'));
    }

    public function tasks()
    {
        $id = Auth::user()->id;
        $submitedTasks = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->get();
        $submitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->count();
        $pendingCount = IndividualTask::with('task')->where('studId', $id)->where('status', '0')->count();
        $overdueCount = IndividualTask::with('task')->where('studId', $id)->where('status', '3')->count();
        $resubmitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '2')->count();
        $completeCount = IndividualTask::with('task')->where('studId', $id)->where('status', '4')->count();

        $submitedTasks = IndividualTask::with('task', 'individual')->where('studId', $id)->where('status', '1')->get();
        $submitedTasks->map(function ($tsk) {
            $tsk->indi_status = $tsk->individual ? $tsk->individual->status : null;
            $tsk->task_name = $tsk->task->name;
            $tsk->scheduleDate = $tsk->individual ? $tsk->individual->scheduleDate : null;
            $tsk->scheduleTime = $tsk->individual ? $tsk->individual->scheduleTime : null;
            return $tsk;
        });

        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();

        return view('user.tasks', compact('submitedTasks', 'submitCount', 'pendingCount', 'overdueCount', 'resubmitCount', 'completeCount', 'notifications'));
    }

    public function taskPending()
    {

        $id = Auth::user()->id;
        $submitedTasks = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->get();
        $submitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->count();
        $pendingCount = IndividualTask::with('task')->where('studId', $id)->where('status', '0')->count();
        $overdueCount = IndividualTask::with('task')->where('studId', $id)->where('status', '3')->count();
        $resubmitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '2')->count();
        $completeCount = IndividualTask::with('task')->where('studId', $id)->where('status', '4')->count();

        $currentDateTime = Carbon::now();
        $tasks = IndividualTask::where('studId', $id)->where('status', '0')->get();

        foreach ($tasks as $task) {
            $deadlineDateTime = Carbon::parse($task->deadlineDate . ' ' . $task->deadlineTime);
            if ($currentDateTime >= $deadlineDateTime) {
                $task->status = '3';
                $task->save();
            }
        }

        $pendingTask = IndividualTask::with('task')->where('studId', $id)->where('status', '0')->get();
        $pendingTask->map(function ($tsk) {
            $tsk->task_name = $tsk->task->name;
            return $tsk;
        });

        // return $pendingTask;
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.taskPending', compact('pendingTask', 'submitCount', 'pendingCount', 'overdueCount', 'resubmitCount', 'completeCount', 'notifications', 'feedback'));
    }

    public function taskOverdue()
    {
        $id = Auth::user()->id;
        $submitedTasks = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->get();
        $submitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->count();
        $pendingCount = IndividualTask::with('task')->where('studId', $id)->where('status', '0')->count();
        $overdueCount = IndividualTask::with('task')->where('studId', $id)->where('status', '3')->count();
        $resubmitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '2')->count();
        $completeCount = IndividualTask::with('task')->where('studId', $id)->where('status', '4')->count();

        $pendingTask = IndividualTask::with('task')->where('studId', $id)->where('status', '3')->get();
        $pendingTask->map(function ($tsk) {
            $tsk->task_name = $tsk->task->name;
            return $tsk;
        });
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.taskOverdue', compact('pendingTask', 'submitCount', 'pendingCount', 'overdueCount', 'resubmitCount', 'completeCount', 'notifications', 'feedback'));
    }

    public function taskResubmit()
    {
        $id = Auth::user()->id;
        $submitedTasks = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->get();
        $submitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '1')->count();
        $pendingCount = IndividualTask::with('task')->where('studId', $id)->where('status', '0')->count();
        $overdueCount = IndividualTask::with('task')->where('studId', $id)->where('status', '3')->count();
        $resubmitCount = IndividualTask::with('task')->where('studId', $id)->where('status', '2')->count();
        $completeCount = IndividualTask::with('task')->where('studId', $id)->where('status', '4')->count();

        $pendingTask = IndividualTask::with('task')->where('studId', $id)->where('status', '2')->get();
        $pendingTask->map(function ($tsk) {
            $tsk->task_name = $tsk->task->name;
            return $tsk;
        });
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.taskResubmit', compact('pendingTask', 'submitCount', 'pendingCount', 'overdueCount', 'resubmitCount', 'completeCount', 'notifications', 'feedback'));
    }

    public function taskIndivisualComplete()
    {
        $id = Auth::user()->id;
        $completeTask = IndividualTask::with('task', 'student')->where('studId', $id)->where('status', '4')->get(); //work remain
        $completeTask->map(function ($indi) {
            $indi->stud_id = $indi->student->id;
            $indi->stud_name = $indi->student->name;
            $indi->taskId = $indi->task->id;
            $indi->task_name = $indi->task->name;
            $indi->task_questions = $indi->task->desc;
            $indi->school_name = $indi->school->school_name;
            return $indi;
        });
        // return $completeTask;
        $submitedTask = StudentTask::get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.taskIndivisualComplete', compact('submitedTask', 'completeTask', 'notifications', 'feedback'));
    }

    public function taskIndivisualSubmitted()
    {
        $id = Auth::user()->id;
        $SubmitedTask = IndividualTask::with('task', 'student')->where('studId', $id)->where('status', '1')->get(); //work remain
        $SubmitedTask->map(function ($indi) {
            $indi->stud_id = $indi->student->id;
            $indi->stud_name = $indi->student->name;
            $indi->taskId = $indi->task->id;
            $indi->task_name = $indi->task->name;
            $indi->task_questions = $indi->task->desc;
            $indi->school_name = $indi->school->school_name;
            return $indi;
        });
        // return $completeTask;
        $submitedTask = StudentTask::get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.taskIndividualSubmitted', compact('submitedTask', 'SubmitedTask', 'notifications', 'feedback'));
    }

    public function taskStart($id)
    {
        // return $id;
        // $uid = Auth::user()->id;
        $pendingTask = IndividualTask::find($id);

        // $date = $pendingTask->deadlineDate;
        // $time = $pendingTask->deadlineTime;
        // $deadline = new DateTime("$date $time");
        // $now = new DateTime();

        // $interval = $now->diff($deadline);

        // if ($now > $deadline) {
        //     $remainingTime = 'Deadline passed';
        // }
        // return $pendingTask;
        // $pendingTask = IndividualTask::with('task')->where('studId', $uid)->get();
        // $pendingTask->map(function ($tsk) {
        //     $tsk->task_name = $tsk->task->name;
        //     return $tsk;
        // });
        $taskName = Task::where('id', $pendingTask->taskID)->first();
        // return $taskName;
        return view('user.taskStart', compact('pendingTask', 'taskName'));
    }

    public function groupTask($id)
    {
        // return $id;
        $pendingTask = GroupTask::find($id);
        // return $pendingTask;
        $taskName = Task::where('id', $pendingTask->taskID)->first();
        return view('user.groupTask', compact('pendingTask', 'taskName'));
        // return $pendingTask;
    }

    public function submitTasks(Request $request)
    {
        // return $request->all();
        if ($request->hasFile('task_file')) {
            $stud_file = time() . '.' . $request->task_file->extension();
            $request->task_file->move(
                'task_file',
                $stud_file
            );
        } else {
            $stud_file = '';
        }

        $indiTask = IndividualTask::where('taskID', $request->taskId)->where('studId', $request->studId)->latest()->first();
        // return $indiTask;
        $indiTask->status = '1';
        $indiTask->save();

        $attributes = [
            'studId' => $request->studId,
            'taskID' => $request->taskId,
        ];
        $values = [
            'answer' => $request->task_answer,
            'task_file' => $stud_file,
        ];

        StudentTask::updateOrCreate($attributes, $values);



        return redirect()->route('tasks')->with('success', 'Task Submitted Successfully');
    }

    public function submitGroupTasks(Request $request)
    {
        // return $request->all();
        if ($request->hasFile('task_file')) {
            $stud_file = time() . '.' . $request->task_file->extension();
            $request->task_file->move(
                'task_file',
                $stud_file
            );
        } else {
            $stud_file = '';
        }

        $taskId = $request->taskId;
        $studentId = $request->studId;

        $groupTask = GroupTask::where('taskID', $taskId)->where('schoolId', $request->schoolId)
            ->get()
            ->filter(function ($tsk) use ($studentId) {
                $studIds = json_decode($tsk->studIds, true);
                return is_array($studIds) && in_array($studentId, $studIds);
            })
            ->first();
        // return $groupTask;
        if ($groupTask) {
            // Decode the JSON encoded studIds field
            $studIds = json_decode($groupTask->studIds, true);

            if (is_array($studIds) && in_array($studentId, $studIds)) {
                //
                // return "test";
                $groupTask->status = '1';
                $groupTask->save();
                // Do something if the student ID is found
                $attributes = [
                    'studId' => $request->studId,
                    'taskID' => $request->taskId,
                ];
                $values = [
                    'answer' => $request->task_answer,
                    'task_file' => $stud_file,
                ];

                StudentGroupTask::updateOrCreate($attributes, $values);

                return redirect()->route('careerClubTask')->with('success', 'Group Task Submitted Successfully');
            } else {
                return redirect()->route('careerClubTask')->with('failed', 'Student ID does not match');
            }
        } else {
            return redirect()->route('careerClubTaskPending')->with('failed', 'GroupTask record not found');
        }
    }

    public function careerClubTask()
    {
        $id = Auth::user()->id;
        $pendingTaskCount = GroupTask::where('status', '1')
            ->get()
            ->filter(function ($tsk) use ($id) {
                $studIds = json_decode($tsk->studIds, true);
                return in_array($id, $studIds);
            })->count();
        $submitCount = GroupTask::where('status', '1')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $pendingCount = GroupTask::where('status', '0')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $overdueCount = GroupTask::where('status', '3')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $resubmitCount = GroupTask::where('status', '2')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $completeCount = GroupTask::where('status', '4')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();

        // return $completeCount;

        //check the task is in Overdue or not
        $currentDateTime = Carbon::now();
        $pendingTask = GroupTask::where('status', '0')
            ->get()
            ->filter(function ($tsk) use ($id) {
                $studIds = json_decode($tsk->studIds, true);

                return in_array($id, $studIds);
            });

        foreach ($pendingTask as $task) {
            $deadlineDateTime = Carbon::parse($task->deadlineDate . ' ' . $task->deadlineTime);
            if ($currentDateTime >= $deadlineDateTime) {
                $task->status = '3';
                $task->save();
            }
        }

        $submitedTasks = GroupTask::with('task', 'group')
            ->where('status', '1')
            ->get()
            ->filter(function ($tsk) use ($id) {
                $studIds = json_decode($tsk->studIds, true);

                return in_array($id, $studIds);
            })
            ->map(function ($tsk) {
                $tsk->grp_status = $tsk->group ? $tsk->group->status : null;
                $tsk->task_name = $tsk->task->name;
                $tsk->scheduleDate = $tsk->group ? $tsk->group->scheduleDate : null;
                $tsk->scheduleTime = $tsk->group ? $tsk->group->scheduleTime : null;
                return $tsk;
            });

        // return $submitedTasks;
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        $students = User::where('role', 'user')->get();
        return view('user.careerClubTask', compact('students', 'submitedTasks', 'pendingCount', 'submitCount', 'resubmitCount', 'overdueCount', 'completeCount', 'notifications', 'feedback'));
    }

    public function careerClubTaskPending()
    {
        $id = Auth::user()->id;
        $submitCount = GroupTask::where('status', '1')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $pendingCount = GroupTask::where('status', '0')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $overdueCount = GroupTask::where('status', '3')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $resubmitCount = GroupTask::where('status', '2')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $completeCount = GroupTask::where('status', '4')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();

        $currentDateTime = Carbon::now();
        $pendingTask = GroupTask::with('task')
            ->where('status', '0')
            ->get()
            ->filter(function ($tsk) use ($id) {
                $studIds = json_decode($tsk->studIds, true);

                return in_array($id, $studIds);
            })
            ->map(function ($tsk) {
                $tsk->task_name = $tsk->task->name;
                return $tsk;
            });

        foreach ($pendingTask as $task) {
            $deadlineDateTime = Carbon::parse($task->deadlineDate . ' ' . $task->deadlineTime);
            if ($currentDateTime >= $deadlineDateTime) {
                $task->status = '3';
                $task->save();
            }
        }
        $students = User::where('role', 'user')->get();
        // return $pendingTask;
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.careerClubTaskPending', compact('pendingTask', 'students', 'pendingCount', 'submitCount', 'resubmitCount', 'overdueCount', 'completeCount', 'notifications', 'feedback'));
    }

    public function careerClubTaskOverdue()
    {
        $id = Auth::user()->id;
        $submitCount = GroupTask::where('status', '1')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $pendingCount = GroupTask::where('status', '0')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $overdueCount = GroupTask::where('status', '3')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $resubmitCount = GroupTask::where('status', '2')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $completeCount = GroupTask::where('status', '4')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();

        $overdueTask = GroupTask::with('task')
            ->where('status', '3')
            ->get()
            ->filter(function ($tsk) use ($id) {
                $studIds = json_decode($tsk->studIds, true);

                return in_array($id, $studIds);
            })
            ->map(function ($tsk) {
                $tsk->task_name = $tsk->task->name;
                return $tsk;
            });

        $students = User::where('role', 'user')->get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.careerClubTaskOverdue', compact('pendingCount', 'submitCount', 'resubmitCount', 'overdueCount', 'completeCount', 'overdueTask', 'students', 'notifications', 'feedback'));
    }

    public function careerClubTaskResubmit()
    {
        $id = Auth::user()->id;
        $submitCount = GroupTask::where('status', '1')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $pendingCount = GroupTask::where('status', '0')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $overdueCount = GroupTask::where('status', '3')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $resubmitCount = GroupTask::where('status', '2')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();
        $completeCount = GroupTask::where('status', '4')->get()->filter(function ($tsk) use ($id) {
            $studIds = json_decode($tsk->studIds, true);
            return in_array($id, $studIds);
        })->count();

        $resubmitTask = GroupTask::with('task')
            ->where('status', '2')
            ->get()
            ->filter(function ($tsk) use ($id) {
                $studIds = json_decode($tsk->studIds, true);

                return in_array($id, $studIds);
            })
            ->map(function ($tsk) {
                $tsk->task_name = $tsk->task->name;
                return $tsk;
            });

        $students = User::where('role', 'user')->get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.careerClubTaskResubmit', compact('pendingCount', 'submitCount', 'resubmitCount', 'overdueCount', 'completeCount', 'resubmitTask', 'students', 'notifications', 'feedback'));
    }

    public function taskGroupComplete()
    {
        // return "test";
        // $id = Auth::user()->id;
        // $completeTask = GroupTask::with('task', 'school')
        //     ->where('status', '4')
        //     ->get()
        //     ->filter(function ($tsk) use ($id) {
        //         $studIds = json_decode($tsk->studIds, true);
        //         return in_array($id, $studIds);
        //     })
        //     ->map(function ($tsk) {
        //         $tsk->task_name = $tsk->task->name;
        //         $tsk->task_questions = $tsk->task->desc;
        //         $tsk->school_name = $tsk->school->school_name;
        //         return $tsk;
        //     });
        $id = Auth::user()->id;

        $completeTask = GroupTask::with('task', 'school')
            ->where('status', '4')
            ->get()
            ->filter(function ($tsk) use ($id) {
                return in_array(
                    $id,
                    json_decode($tsk->studIds, true)
                );
            })
            ->map(function ($tsk) {
                $tsk->task_name = $tsk->task ? $tsk->task->name : null;
                $tsk->task_questions = $tsk->task ? $tsk->task->desc : null;
                $tsk->school_name = $tsk->school ? $tsk->school->school_name : null;
                return $tsk;
            });

        // return $completeTask;
        $submitedTask = StudentGroupTask::with('student')->where('studId', $id)->get();
        // return $submitedTask;
        $students = User::where('role', 'user')->get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.taskGroupComplete', compact('submitedTask', 'completeTask', 'notifications', 'feedback', 'students'));
    }
    public function taskGroupSubmitted()
    {

        $id = Auth::user()->id;

        $SubmittedTask = GroupTask::with('task', 'school')
            ->where('status', '1')
            ->get()
            ->filter(function ($tsk) use ($id) {
                return in_array(
                    $id,
                    json_decode($tsk->studIds, true)
                );
            })
            ->map(function ($tsk) {
                $tsk->task_name = $tsk->task ? $tsk->task->name : null;
                $tsk->task_questions = $tsk->task ? $tsk->task->desc : null;
                $tsk->school_name = $tsk->school ? $tsk->school->school_name : null;
                return $tsk;
            });

        // return $completeTask;
        $submitedTask = StudentGroupTask::with('student')->where('studId', $id)->get();
        // return $submitedTask;
        $students = User::where('role', 'user')->get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.taskGroupSubmited', compact('submitedTask', 'SubmittedTask', 'notifications', 'feedback', 'students'));
    }

    public function scheduleIndividualTask(Request $request)
    {
        // return $request->all();
        $schedule = ScheduleTask::where('studId', $request->stud_id)
            ->where('taskID', $request->task_id)
            ->where('schoolId', $request->school_id)
            ->where('indiTaskId', $request->indi_id)->latest()
            ->first();

        if ($schedule) {
            $schedule->status = '1';
            $schedule->save();
        } else {
            $scheduleCall = new ScheduleTask();
            $scheduleCall->studId = $request->stud_id;
            $scheduleCall->taskID = $request->task_id;
            $scheduleCall->schoolId = $request->school_id;
            $scheduleCall->indiTaskId = $request->indi_id;
            $scheduleCall->scheduleDate = $request->scheduleDate;
            $scheduleCall->scheduleTime = $request->scheduleTime;
            $scheduleCall->status = '1';
            $scheduleCall->save();

            $scheduleDateTime = $request->scheduleDate . ' at ' . $request->scheduleTime;
            $indisc = IndividualTask::find($request->indi_id);
            if ($indisc->studId == $request->stud_id) {
                $indisc->scheduleCall = $scheduleDateTime;
                $indisc->save();
            }
        }


        $scheduleDate = Carbon::parse($request->scheduleDate);
        $formattedDate = $scheduleDate->format('d F');
        $title = 'Expert Call is Scheduled on ' . $formattedDate;
        $desc = 'Your career counseling call is scheduled for '
            . $formattedDate . ' at ' . $request->scheduleTime;
        Notification::create(['studId' => $request->stud_id, 'title' => $title, 'description' => $desc]);

        return redirect()->back()->with('success', 'Schedule a call successfully');
    }

    public function scheduleGroupTask(Request $request)
    {
        // return $request->all();
        $scheduleCall = new ScheduleGroupTask;
        $scheduleCall->studId = $request->stud_id;
        $scheduleCall->taskID = $request->task_id;
        $scheduleCall->schoolId = $request->school_id;
        $scheduleCall->grpTaskId = $request->grp_id;
        $scheduleCall->scheduleDate = $request->scheduleDate;
        $scheduleCall->scheduleTime = $request->scheduleTime;
        $scheduleCall->status = '1';
        $scheduleCall->save();

        $scheduleDateTime = $request->scheduleDate . ' at ' . $request->scheduleTime;
        $grpsc = GroupTask::find($request->grp_id);
        $grpsc->scheduleCall = $scheduleDateTime;
        $grpsc->save();
        return redirect()->back()->with('success', 'Schedule a call successfully');
    }

    public function internship()
    {
        $id = Auth::user()->id;
        $internships = Internship::get();
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.internship', compact('internships', 'notifications', 'feedback'));
    }

    public function internshipApply($id)
    {
        $stud_id = Auth::user()->id;
        // $internshipTakeaway = new InternTakeaway;
        // $internshipTakeaway->stud_id = $stud_id;
        // $internshipTakeaway->intern_id = $id;
        // $internshipTakeaway->save();

        return redirect()->back()->with('success', 'Internship Apply successfully');
    }

    public function internshipTakeaway()
    {
        return view('user.internTakeaway');
    }

    public function submitTakeaway(Request $request)
    {
        return $request->all();
    }

    public function careerClub()
    {
        $stud_id = Auth::user()->id;
        $careerOptions = StudentCareerOption::where('stud_id', $stud_id)->latest()->first();

        // $mappingsStr = json_decode($careerOptions->sc_priority, true);
        // $keys = array_keys($mappingsStr);
        // $values = array_values($mappingsStr);
        // sort($keys);
        // sort($values);
        // dd($values);
        // $subCareers = SubCareer::whereIn('id', $values)
        //     ->orderByRaw('FIELD(id, ' . implode(',', $values) . ')')
        //     ->get();

        $careers = Career::with('subCareers')->get();
        $careers->map(function ($career) {
            $career->subCareersCount = $career->subCareers->count();
            return $career;
        });
        // return $careers;
        // $careers->each(function ($career) use ($values) {
        //     $subCareers = SubCareer::whereIn('id', $values)
        //         ->orderByRaw('FIELD(id, ' . implode(',', $values) . ')')
        //         ->get();
        //     // dd($subCareers);
        // });
        // return $careers;
        $feedback = Feedback::where('studId', $stud_id)->first();
        $scheduleCall = ScheduleExpert::where('studId', $stud_id)->first();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();

        return view('user.careerClub', compact('careers', 'notifications', 'feedback', 'scheduleCall'));
    }

    public function careerClubRank()
    {
        $stud_id = Auth::user()->id;
        $careerOptions = StudentCareerOption::where('stud_id', $stud_id)->latest()->first();


        // $careers = Career::with('subCareers')->get();
        $subCareer = SubCareer::with('career')->get();
        $subCareer->map(function ($subCareer) {
            $subCareer->career_name = $subCareer->career->name;
            return $subCareer;
        });
        //return $subCareer;
        $feedback = Feedback::where('studId', $stud_id)->first();
        $scheduleCall = ScheduleExpert::where('studId', $stud_id)->first();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();

        return view('user.careerClubRank', compact('subCareer', 'notifications', 'feedback', 'scheduleCall', 'careerOptions'));
    }
    public function careerGoal()
    {
        $stud_id = Auth::user()->id;
        $stud_name = Auth::user()->name;
        $careerClub = CareerClub::get();

        $mom = MOM::where('studId', $stud_id)->get();
        //return $mom;
        // return $careerClub;
        $feedback = Feedback::where('studId', $stud_id)->first();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        return view('user.careerGoal', compact('careerClub', 'notifications', 'feedback', 'stud_name', 'mom'));
    }

    public function careerClubMom($id)
    {
        $careerClub = CareerClub::find($id);
        $stud_id = Auth::user()->id;
        $stud_name = Auth::user()->name;
        return view('user.mom', compact('careerClub', 'stud_id', 'stud_name'));
    }

    public function storecareerClubMom(Request $request)
    {
        //return $request->all();
        $mom = new MOM;
        $mom->cc_id = $request->cc_id;
        $mom->studId = $request->studId;
        $mom->schoolId = $request->schoolId;
        $mom->mom = $request->mom;
        $mom->save();
        return redirect()->route('careerGoal')->with('success', 'MOM Data Added Successfully!!!!');
    }

    public function viewMom($id)
    {
        $stud_id = Auth::user()->id;
        $stud_name = Auth::user()->name;
        $momlist = MOM::where('studId', $stud_id)->where('cc_id', $id)->get();
        //  return $momlist;
        return view('user.viewmom', compact('momlist'));
    }

    public function aiPortal()
    {
        $stud_id = Auth::user()->id;
        $aiPortals = AIPortal::get();
        $feedback = Feedback::where('studId', $stud_id)->first();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        return view('user.aiPortal', compact('aiPortals', 'notifications', 'feedback'));
    }

    public function careerOptions(Request $request, $id)
    {
        $stud_id = Auth::user()->id;
        $career = Career::find($id);
        $subCareer = SubCareer::where('career_id', $career->id)->get();
        $feedback = Feedback::where('studId', $stud_id)->first();
        $scheduleCall = ScheduleExpert::where('studId', $stud_id)->first();
        $notifications = Notification::where('studId', $stud_id)->where('isRead', null)->get();
        $careerOptions = StudentCareerOption::where('stud_id', Auth::user()->id)->latest()->first();
        return view('user.careerOptions', compact('career', 'subCareer', 'notifications', 'feedback', 'scheduleCall', 'careerOptions'));
    }

    public function writeTakeaway($id)
    {
        $dmSession = StudentSession::find($id);
        return view('user.writeTakeaway', compact('dmSession'));
    }

    public function takeaway(Request $request)
    {
        // return $request->all();
        if ($request->hasFile('stud_file')) {
            $fileData = time() . '.' . $request->stud_file->extension();
            $request->stud_file->move(
                'takeaway_file',
                $fileData
            );
        } else {
            $fileData = '';
        }
        $studTakeaway = StudentSession::find($request->sessionId);
        //  return $studTakeaway;
        if ($studTakeaway->status == '0') {
            $studTakeaway->takeaway = $request->desc;
            $studTakeaway->stud_file = $fileData;
            $studTakeaway->status = '1';
            $studTakeaway->save();
        } elseif ($studTakeaway->status == '2') {
            $studTakeaway->takeaway = $request->desc;
            $studTakeaway->stud_file = $fileData;
            $studTakeaway->status = '2';
            $studTakeaway->save();
        }
        return redirect()->route('counselling')->with('success', 'Takeaway Submitted');
    }

    // public function myProfile()
    // {
    //     $school = SchoolDetail::find(Auth::user()->school_id);
    //     return view('user.myProfile', compact('school'));
    // }
    public function myProfile()
    {
        $stud_id = Auth::user()->id;
        $stud_name = Auth::user()->name;
        $attendedWorkshop = false;
        $attendance = Attendance::with('workshop')->get();
        foreach ($attendance as $att) {
            $studattArray = json_decode($att->attendance);
            if (!is_array($studattArray)) {
                $studattArray = [];
            }
            if (in_array($stud_id, $studattArray)) {
                $attendedWorkshop = true;
            }
        }
        $dmsession = StudentSession::where('studId', $stud_id)->where('status', '2')->first();
        $internship = InternTakeaway::where('stud_id', $stud_id)->where('status', '1')->first();
        // return $internship;
        $studentTask = StudentTask::where('studId', $stud_id)->first();
        $studentCareerOption = StudentCareerOption::where('stud_id', $stud_id)->first();
        // return $studentTask;
        return view('user.myProfile', compact('dmsession', 'attendedWorkshop', 'studentTask', 'studentCareerOption', 'internship'));
    }

    public function editStudent($id)
    {
        $stud = User::find($id);
        $school = SchoolDetail::get();
        return view('user.editstudent', compact('stud', 'school'));
    }

    public function updateStudent(Request $request)
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
        return redirect()->route('myProfile')->with('success', 'Data Updated Successfully!!!!');
    }

    public function completeProfile()
    {
        $id = Auth::user()->id;
        $profileData = StudentProfile::where('studId', $id)->first();
        // return $profileData;
        return view('user.completeProfile', compact('profileData'));
    }

    public function completeProfileData(Request $request)
    {
        // return $request->all();
        $profile = new StudentProfile;
        $profile->studId = $request->stud_id;
        $profile->studWant = $request->studWant;
        $profile->fathWant = $request->fathWant;
        $profile->mothWant = $request->mothWant;
        $profile->studDream = $request->studDream;
        $profile->familyIncome = $request->familyIncome;
        $profile->outcome = $request->outcome;
        $profile->otherInfo = $request->otherInfo;
        $profile->doAcademic = $request->doAcademic;
        $profile->save();

        return redirect()->route('myProfile')->with('success', 'Student profile Updated successfully..');
    }

    public function progressVideo()
    {
        $id = Auth::user()->id;
        // $studInfo = User::find($id);
        $videos = ProgressVideo::with('student')->where('status', '1')->get();
        $videos->map(function ($stud) {
            $stud->stud_name = $stud->student->name;
            $stud->stud_std = $stud->student->std;
            return $stud;
        });
        // return $studInfo;
        $feedback = Feedback::where('studId', $id)->first();
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.progressVideo', compact('videos', 'notifications', 'feedback'));
    }

    public function getCustomerProfile(Request $request)
    {
        // $student = $request->input('sid');
        // $data = User::where('id', $request->input('sid'))->where('role', 'user')->first();
        $data = studentProfile::where('studId', $request->input('sid'))->first();

        if (!$data) {
            return response()->json(['error' => 'Profile is not completed'], 404);
        }

        // if (!$data->studWant || !$data->fathWant || !$data->mothWant  || !$data->studDream || !$data->familyIncome || !$data->outcome || !$data->otherInfo || !$data->doAcademic) {
        //     return response()->json(['error' => 'Profile is not completed'], 422);
        // }

        return response()->json($data);
    }

    public function uploadVideo()
    {
        $id = Auth::user()->id;
        $notifications = Notification::where('studId', $id)->where('isRead', null)->get();
        return view('user.uploadVideo', compact('notifications'));
    }

    public function uploadVideoFile(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mov|max:4096',
            'desc' => 'required'
        ]);

        if ($request->hasFile('video')) {
            $videoName = time() . '.' . $request->video->extension();
            $request->video->move('video', $videoName);
        } else {
            $videoName = "";
        }
        // return $request->all();
        $videos = new ProgressVideo;
        $videos->studId = $request->stud_id;
        $videos->video = $videoName;
        $videos->desc = $request->desc;
        $videos->save();
        return redirect()->route('progressVideo')->with('success', 'Video uploaded Successfully');
    }

    public function feedBack(Request $request)
    {
        $stud_id = Auth::user()->id;
        $existingFeedback = Feedback::where('studId', $stud_id)->first();
        if ($existingFeedback) {
            return redirect()->back()->with('failed', 'You have already submitted feedback.');
        } else {
            $feedback = new Feedback;
            $feedback->studId = $stud_id;
            $feedback->type = $request->image_value;
            $feedback->desc = $request->feedback;
            $feedback->status = '1';
            $feedback->save();
            return redirect()->back()->with('success', 'Feedback Successfully submitted');
        }
    }

    public function markAsRead(Request $request)
    {

        $notificationId = $request->input('nid');
        $notification = Notification::find($notificationId);

        if (!$notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->isRead = true;
        $notification->save();

        return response()->json($notification);
    }
}
