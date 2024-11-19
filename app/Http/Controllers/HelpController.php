<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function help()
    {
        $help = Customer::where('status', 'on')->get();
        return view('user.help', compact('help'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        $store = new Help;
        $store->cID = $request->cID;
        $store->question = $request->question;
        $store->desc = $request->desc;
        $store->save();
        return back();
    }
}
