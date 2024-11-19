<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;
    public $guarded = [];

    public function userData()
    {
        return $this->hasOne(User::class, 'id', 'cID');
    }
}
