<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\User;
use App\Models\UserQuestion;
use Illuminate\Http\Request;

class UserQuestionController extends Controller
{
    public function userquestion()
    {
        $help = Help::with('userData')->get();
        $user = user::get();
        // return $user;
        // return $help;
        return view('admin.userquestion', compact('help', 'user'));
    }
}
