<?php

namespace App\Console\Commands;

use DateTime;
use App\Models\IndividualTask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class IndividualTaskMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:taskmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to users for task Remainder.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $inditask = IndividualTask::get();
        $inditask->map(function ($indi) {
            $indi->stud_id = $indi->student->id;
            $indi->stud_name = $indi->student->name;
            $indi->stud_email = $indi->student->email;
            $indi->taskId = $indi->task->id;
            $indi->task_name = $indi->task->name;
            return $indi;
        });

        foreach ($inditask as $ilist) {
            $date = $ilist->deadlineDate;
            $time = $ilist->deadlineTime;
            $dateTimeString = $date . ' ' . $time;
            $deadline = new DateTime($dateTimeString);
            $now = new DateTime();
            $interval = $now->diff($deadline);
            $difference = $interval->format('%r%d');
            if ($ilist->deadlineDate < date('Y-m-d')) {
                if ($ilist->status == 3) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'Please submit your overdue DM task. Click here to submit. Please feel free to reach out to us in case of any doubts.',
                    ];
                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Overdue Task Mail.');
                    });
                }
            } elseif ($difference == 0) {
                if ($ilist->status == 0) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'Your DM task is due today. Please submit it on your dashboard.',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Pending Task Remainder Mail.');
                    });
                } elseif ($ilist->status == 4) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'Hurray! Your DM Task is accepted by the counselor.',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Submitted Task Mail.');
                    });
                } elseif ($ilist->status == 2) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'We are so sorry to inform you that your DM task was rejected by the counselor Please click here to check for reasons.Kindly resubmit the task in 7 days.',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Resubmitted Task Mail.');
                    });
                } elseif ($ilist->status == 3) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'We see you have missed the DM task submission deadline, are you facing an issue?',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Task Overdue Mail.');
                    });
                }
            } elseif ($difference == 1) {
                if ($ilist->status == 0) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'Your DM task is due tomorrow, are you ready to submit it?',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Task Pending Remainder Mail.');
                    });
                } elseif ($ilist->status == 4) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'Hurray! Your DM Task is accepted by the counselor.',
                    ];
                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Task Submitted Mail.');
                    });
                } elseif ($ilist->status == 2) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'We are so sorry to inform you that your DM task was rejected by the counselor Please click here to check for reasons.Kindly resubmit the task in 7 days.',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Task Resubmitted Mail.');
                    });
                }
            } elseif ($difference == 2) {
                if ($ilist->status == 0) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'Your DM task is due soon. We hope you are working on it!',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Task Pending Remainder Mail.');
                    });
                } elseif ($ilist->status == 4) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'Hurray! Your DM Task is accepted by the counselor.',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Task Submitted Mail.');
                    });
                } elseif ($ilist->status == 2) {
                    $inditaskmailData = [
                        'student_name' => $ilist->stud_name,
                        'task_name' => $ilist->task_name,
                        'massage' => 'We are so sorry to inform you that your DM task was rejected by the counselor Please click here to check for reasons.Kindly resubmit the task in 7 days.',
                    ];


                    Mail::send('admin.task.indiTaskMail', ['inditaskmailData' => $inditaskmailData], function ($message) use ($ilist) {
                        $message->to($ilist->stud_email)
                            ->subject('This is Task Resubmitted Mail.');
                    });
                }
            }
        }
    }
}
