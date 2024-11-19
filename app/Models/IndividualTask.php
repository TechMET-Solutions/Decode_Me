<?php

namespace App\Models;

use App\Models\ScheduleTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndividualTask extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function student()
    {
        return $this->hasOne(User::class, 'id', 'studId');
    }
    public function task()
    {
        return $this->hasOne(Task::class, 'id', 'taskID');
    }
    public function school()
    {
        return $this->hasOne(SchoolDetail::class, 'id', 'schoolId');
    }

    public function individual()
    {
        return $this->hasOne(ScheduleTask::class, 'indiTaskId', 'id')->latest();
    }
}
