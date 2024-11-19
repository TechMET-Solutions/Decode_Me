<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSession extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function expert()
    {
        return $this->hasOne(Expert::class, 'id', 'ex_id');
    }
    public function student()
    {
        return $this->hasOne(User::class, 'id', 'studId');
    }
}
