<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\UserOtp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        //Super Admin Bypass OTP
        if ($user->hasRole('super_admin')) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
            }

        //Others -Generate OTP and Send Mail and Redirect to OTP Verification Page
        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        //Save OTP to database
        UserOtp::where('user_id', $user->id)->delete(); // Delete any existing OTPs for the user
        UserOtp::updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => Hash::make($otp),
            'expires_at' => Carbon::now()->addMinutes(5)]
        );
        //Send OTP Mail
        Mail::to($user->email)->send(new OtpMail($otp));

        //Store user id in session for later verification
        $request->session()->put('otp_user_id', $user->id);
        $request->session()->put('remember', $request->boolean('remember'));

        return redirect()->route('otp.show')->with('status', 'OTP has been sent to your email address. It is valid for 5 minutes.');

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
