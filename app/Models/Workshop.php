<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'id', 'workshop_id');
    }
}
