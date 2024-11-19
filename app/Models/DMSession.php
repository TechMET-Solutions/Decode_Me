<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DMSession extends Model
{
    use HasFactory;
    public function studSession()
    {
        return $this->hasMany(StudentSession::class, 'dmsessionId', 'id');
    }
}
