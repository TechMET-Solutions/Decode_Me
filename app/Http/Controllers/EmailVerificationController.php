<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailVerification;

class EmailVerificationController extends Controller
{
    public function showVerifyOtpForm(Request $request)
    {
        // return $request->all();
        return view('auth.verify-otp', ['email' => $request->email]);
    }

    public function verifyOTP(Request $request)
    {
        // return $request->all();
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$verification || $verification->expires_at->isPast()) {
            return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Allow registration to complete
        return redirect()->route('complete.registration', ['email' => $request->email]);
    }
}
