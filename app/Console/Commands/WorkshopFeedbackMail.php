<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Workshop;
use App\Models\Attendance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class WorkshopFeedbackMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:workshopmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to users for Workshop Feedback .';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $workshop = Workshop::where('end_date', date('Y-m-d'))->first();
        $attendance = Attendance::where('workshop_id', $workshop->id)
            ->where('date', $workshop->end_date)->get();
        foreach ($attendance as $salist) {
            $attendancestudents = json_decode($salist->attendance);
            foreach ($attendancestudents as $stud) {
                $students = User::where('role', 'user')->get();
                foreach ($students as $studlist) {
                    if ($stud == $studlist->id) {
                        $workshopmailData = [
                            'workshop' => $workshop->topic,
                            'student_name' => $studlist->name,
                        ];
                        Mail::send('admin.workshop.workshopmail', ['workshopmailData' => $workshopmailData], function ($message) use ($studlist) {
                            $message->to($studlist->email)
                                ->subject('This is Workshop Feedback Mail.');
                        });
                    }
                }
            }
        }
    }
}
