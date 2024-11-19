<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    public function subCareers()
    {
        return $this->hasMany(SubCareer::class);
    }
}
