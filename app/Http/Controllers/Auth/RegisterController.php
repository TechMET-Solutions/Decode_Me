<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\OtpMail;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use App\Models\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $schools = SchoolDetail::all();
        //  return $schools;
        return view('auth.register', compact('schools'));
    }

    public function register(Request $request)
    {
        // return $request->all();
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $otp = rand(100000, 999999);

        EmailVerification::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(10)]
        );

        Mail::to($request->email)->send(new OtpMail($otp));

        // Store user data in session temporarily
        $request->session()->put('registration_data', $request->only('name', 'email', 'school_id', 'password'));

        return redirect()->route('verify.otp.form', ['email' => $request->email]);
    }

    public function completeRegistration(Request $request)
    {
        $data = $request->session()->get('registration_data');
        //  return $data;

        if (!$data) {
            return redirect()->route('register');
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'school_id' => $data['school_id'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        // Clear the session data after registration
        $request->session()->forget('registration_data');

        return redirect()->route('home');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'school_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function forgotPassword($email = null)
    {
        if ($email) {
            $data = User::where('email', $email)->first();
        } else {
            $data = '';
        }

        return view('auth.forgotPassword', compact('data'));
    }

    public function verifyEmail(Request $request)
    {
        // return $request->all();
        $email = $request->input('email');
        $otp = rand(100000, 999999);

        EmailVerification::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(10)]
        );

        // Send OTP to email
        $data = User::where('email', $email)->first();
        // return $data;
        if ($data) {

            Mail::to($data->email)->send(new OtpMail($otp));

            return response()->json($data);
        }
    }

    public function emailVerifyOtp(Request $request)
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

        $userData = User::where('email', $request->email)->first();

        return view('user.changePassword', compact('userData'));
    }

    public function changePassword(Request $request)
    {
        // return $request->all();
        $userData = User::find($request->stud_id);
        $userData->password = Hash::make($request->password);
        $userData->save();
        return redirect()->route('login')->with('success', 'Password Change Successfully');
    }
}
