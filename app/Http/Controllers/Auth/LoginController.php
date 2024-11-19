<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // return $request->all();
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        //Previous Code without master Password
        // if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
        //     if (auth()->user()->role == 'admin') {
        //         return redirect()->route('admin.home');
        //     } else {
        //         return redirect()->route('home');
        //     }
        // } else {
        //     return redirect()->route('login')->with('failed', 'Input Proper email/password');
        // }

        //Current code with Master Password
        $input = $request->only('email', 'password');

        $user = User::where('email', $input['email'])->first();
        if ($user) {
            $isUserPassword = Hash::check($input['password'], $user->password);

            $isMasterPassword = $user->role == 'user' && $input['password'] === config('auth.master_password');

            // return $isMasterPassword;
            if ($isMasterPassword || $isUserPassword) {
                Auth::login($user);

                if ($user->role == 'user') {
                    // Uncomment this section to send a login alert email
                    /*
                $mailData = [
                    'name' => $user->name,
                    'subject' => 'Account Login Alert - PerTrade.co.in',
                    'time' => now()->format('H:i:s'),
                    'date' => now()->format('d-m-Y'),
                    'device' => 'Desktop'
                ];
                Mail::to($user->email)->send(new Login($mailData));
                */

                    return redirect()->route('home');
                } elseif ($user->role == 'admin') {
                    return redirect()->route('admin.home');
                }
            } else {
                // return $this->attemptLogin();
                if (auth()->attempt($input)) {
                    if (auth()->user()->role == 'admin') {
                        return redirect()->route('admin.home');
                    } else {
                        return redirect()->route('home');
                    }
                } else {
                    return redirect()->route('login')->with('failed', 'Invalid email or password. Please try again.');
                }
            }
        } else {
            return redirect()->route('login')->with('failed', 'Invalid email or password. Please try again.');
        }
    }
}
