<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        return view('user.contact');
    }

    public function storecontact(Request $request)
    {
        return $request->all();
        // $contact = new Contact;
        // $contact->name = $request->name;
        // $contact->mobile = $request->mobile;
        // $contact->email = $request->email;
        // $contact->password = $request->password;
        // $contact->desc = $request->desc;
        // // return $contact;  
        // $contact->save();
        $mailData = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email
        ];
        Mail::to('anushreesaindane05@gmail.com')->send(new DemoMail($mailData));
        return redirect()->back()->with('success', 'Mail Send successfully');
    }
}
