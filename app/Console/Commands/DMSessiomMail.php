<?php

namespace App\Console\Commands;

use DateTime;
use App\Models\StudentSession;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DMSessiomMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:sessionmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to users for DM Session Remainder.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $studsession = StudentSession::get();
        $studsession->map(function ($ss) {
            $ss->studId = $ss->student->id;
            $ss->stud_name = $ss->student->name;
            $ss->stud_email = $ss->student->email;
            $ss->ex_id = $ss->expert->id;
            $ss->expert_name = $ss->student->name;
        });
        // return $studsession;
        foreach ($studsession as $dms) {
            $date = $dms->date;
            $deadline = new DateTime($date);
            $now = new DateTime();
            $interval = $now->diff($deadline);
            $difference = $interval->format('%d');
            // return  $difference;&& $dms->date == date('Y-m-d')
            if ($difference == 0) {
                if ($dms->status == 0) {
                    $dmSessionMailData = [
                        'student_name' => $dms->stud_name,
                        'date' => $dms->date,
                        'time' => $dms->time,
                    ];
                    Mail::send('admin.dmsession.dmsessionmail2', ['dmSessionMailData' => $dmSessionMailData], function ($message) use ($dms) {
                        $message->to($dms->stud_email)
                            ->subject('This is DM Session Remainder Mail.');
                    });
                } elseif ($dms->status == 1) {
                    //return $dms->stud_email;
                    $dmSessionMailData = [
                        'student_name' => $dms->stud_name,
                        'date' => $dms->date,
                        'time' => $dms->time,
                    ];
                    Mail::send('admin.dmsession.dmsessionmail2', ['dmSessionMailData' => $dmSessionMailData], function ($message) use ($dms) {
                        $message->to($dms->stud_email)
                            ->subject('This is DM Session Remainder Mail.');
                    });
                }
            } elseif ($difference == 1) {
                if ($dms->status == 0) {
                    $dmSessionMailData = [
                        'student_name' => $dms->stud_name,
                        'date' => $dms->date,
                        'time' => $dms->time,
                    ];
                    Mail::send('admin.dmsession.dmsessionmail', ['dmSessionMailData' => $dmSessionMailData], function ($message) use ($dms) {
                        $message->to($dms->stud_email)
                            ->subject('This is DM Session Remainder Mail.');
                    });
                } elseif ($dms->status == 1) {
                    $dmSessionMailData = [
                        'student_name' => $dms->stud_name,
                        'date' => $dms->date,
                        'time' => $dms->time,
                    ];
                    Mail::send('admin.dmsession.dmsessionmail', ['dmSessionMailData' => $dmSessionMailData], function ($message) use ($dms) {
                        $message->to($dms->stud_email)
                            ->subject('This is DM Session Remainder Mail.');
                    });
                }
            } elseif ($difference == 0 && $dms->date == date('Y-m-d')) {
                if ($dms->status == 0) {
                    $dmSessionMailData = [
                        'student_name' => $dms->stud_name,
                        'date' => $dms->date,
                        'time' => $dms->time,
                    ];
                    Mail::send('admin.dmsession.dmsessionmail3', ['dmSessionMailData' => $dmSessionMailData], function ($message) use ($dms) {
                        $message->to($dms->stud_email)
                            ->subject('This is DM Session Remainder Mail.');
                    });
                } elseif ($dms->status == 1) {
                    $dmSessionMailData = [
                        'student_name' => $dms->stud_name,
                        'date' => $dms->date,
                        'time' => $dms->time,
                    ];
                    Mail::send('admin.dmsession.dmsessionmail3', ['dmSessionMailData' => $dmSessionMailData], function ($message) use ($dms) {
                        $message->to($dms->stud_email)
                            ->subject('This is DM Session Remainder Mail.');
                    });
                }
            }
        }
    }
}
