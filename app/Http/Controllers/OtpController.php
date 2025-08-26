<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    //
    public function show()
    {
        abort_unless((session()->has('otp_user_id')), 403);
        return view('auth.otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user_id = session('otp_user_id');
        $remember = (bool) session('remember');

        $record = UserOtp::where('user_id', $user_id)
            ->where('otp', $request->otp)->first();
        

        if (! $record || Carbon::now()->greaterThan($record->expires_at)) {
            throw ValidationException::withMessages(['otp' => 'Invalid OTP. or expired OTP.']);
        }

        // Consume the OTP

        $record->delete();

        $user = User::find($user_id);
        session()->forget('otp_user_id');
        Auth::login($user, $remember);
        request()->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

}
