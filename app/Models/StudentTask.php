<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
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
}
