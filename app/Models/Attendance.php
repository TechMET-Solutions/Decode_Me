<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public function school()
    {
        return $this->hasOne(SchoolDetail::class, 'id', 'school_id');
    }
    public function workshop()
    {
        return $this->hasOne(Workshop::class, 'id', 'workshop_id');
    }
    public function students()
    {
        return $this->hasMany(User::class, 'school_id', 'school_id'); 
    }
}
