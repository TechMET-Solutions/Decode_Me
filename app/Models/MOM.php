<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOM extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->hasOne(User::class, 'id', 'studId');
    }
    public function school()
    {
        return $this->hasOne(SchoolDetail::class, 'id', 'schoolId');
    }
    public function careerclub()
    {
        return $this->hasOne(CareerClub::class, 'id', 'cc_id');
    }
}
