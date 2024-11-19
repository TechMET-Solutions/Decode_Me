<?php

namespace App\Models;

use App\Models\ScheduleGroupTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupTask extends Model
{
    use HasFactory;
    public function task()
    {
        return $this->hasOne(Task::class, 'id', 'taskID');
    }
    public function school()
    {
        return $this->hasOne(SchoolDetail::class, 'id', 'schoolId');
    }

    public function studTask()
    {
        return $this->hasOne(StudentTask::class, 'id', 'taskID');
    }

    public function group()
    {
        return $this->hasOne(ScheduleGroupTask::class, 'grpTaskId', 'id');
    }
}
