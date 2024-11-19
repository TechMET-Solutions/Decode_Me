<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    use HasFactory;
    public $guarded = [];
    public function userQuestion()
    {
        return $this->hasMany(Help::class, 'cID', 'user_id');
    }
}
