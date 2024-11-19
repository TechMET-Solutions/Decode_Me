<?php

namespace App\Console\Commands;

use DateTime;
use App\Models\User;
use App\Models\GroupTask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GroupTaskMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:grouptaskmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to users for Group Task Remainder.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $group = GroupTask::with('task', 'school')->get();
        $group->map(function ($grp) {
            $grp->taskId = $grp->task->id;
            $grp->task_name = $grp->task->name;
            $grp->task_questions = $grp->task->desc;
            $grp->school_name = $grp->school->school_name;
        });
        foreach ($group as $gtlist) {
            $gpstudents = json_decode($gtlist->studIds);
            $date = $gtlist->deadlineDate;
            $time = $gtlist->deadlineTime;
            $dateTimeString = $date . ' ' . $time;
            $deadline = new DateTime($dateTimeString);
            $now = new DateTime();
            $interval = $now->diff($deadline);
            $difference = $interval->format('%r%d');
            foreach ($gpstudents as $gstud) {
                $students = User::where('role', 'user')->get();
                foreach ($students as $studlist) {
                    if ($gstud == $studlist->id) {
                        if ($difference == 0) {
                            if ($gtlist->status == 0) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'Your Career Club Task is due today. Please submit it on your dashboard.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Pending Career Club Task Remainder Mail.');
                                });
                            } elseif ($gtlist->status == 4) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'Hurray! Your Career Club Task is accepted by the counselor.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Submitted Career Club Task Mail.');
                                });
                            } elseif ($gtlist->status == 2) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'We are so sorry to inform you that your Career Club Task was rejected by the counselor Please click here to check for reasons.Kindly resubmit the task in 7 days.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Resubmitted Career Club Task Mail.');
                                });
                            } elseif ($gtlist->status == 3) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'We see you have missed the Career Club Task submission deadline, are you facing an issue?',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Overdue Career Club Task Mail.');
                                });
                            }
                        } elseif ($difference == 1) {
                            if ($gtlist->status == 0) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'Your Career Club Task is due tomorrow, are you ready to submit it?',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Pending Career Club Task Remainder Mail.');
                                });
                            } elseif ($gtlist->status == 4) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'Hurray! Your Career Club Task is accepted by the counselor.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Submitted Career Club Task Mail.');
                                });
                            } elseif ($gtlist->status == 2) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'We are so sorry to inform you that your Career Club Task was rejected by the counselor Please click here to check for reasons.Kindly resubmit the task in 7 days.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Resubmitted Career Club Task Mail.');
                                });
                            }
                        } elseif ($difference >= 2) {
                            if ($gtlist->status == 0) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'Your Career Club Task is due soon. We hope you are working on it!',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Pending Career Club Task Remainder Mail.');
                                });
                            } elseif ($gtlist->status == 4) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'Hurray! Your Career Club Task is accepted by the counselor.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Submitted Career Club Task Mail.');
                                });
                            } elseif ($gtlist->status == 2) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'We are so sorry to inform you that your Career Club Task was rejected by the counselor Please click here to check for reasons.Kindly resubmit the task in 7 days.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Resubmitted Career Club Task Mail.');
                                });
                            }
                        } else if ($gtlist->deadlineDate < date('Y-m-d')) {
                            if ($gtlist->status == 3) {
                                $grouptaskmailData = [
                                    'student_name' => $studlist->name,
                                    'task_name' => $gtlist->task_name,
                                    'massage' => 'Please submit your overdue Career Club task. Click here to submit. Please feel free to reach out to us in case of any doubts.',
                                ];
                                Mail::send('admin.task.groupTaskMail', ['grouptaskmailData' => $grouptaskmailData], function ($message) use ($studlist) {
                                    $message->to($studlist->email)
                                        ->subject('This is Overdue Career Club Task Mail.');
                                });
                            }
                        }
                    }
                }
            }
        }
    }
}
