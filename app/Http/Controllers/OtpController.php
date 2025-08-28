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
    /**
     * Show OTP input form
     */
    public function show()
    {
        abort_unless(session()->has('otp_user_id'), 403);

        return view('auth.otp');
    }

    /**
     * Verify the OTP
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user_id = session('otp_user_id');
        $remember = (bool) session('remember');

        $record = UserOtp::where('user_id', $user_id)->first();

        if (
            ! $record ||
            ! Hash::check($request->otp, $record->otp) || 
            Carbon::now()->greaterThan($record->expires_at)
        ) {
            throw ValidationException::withMessages([
                'otp' => 'Invalid or expired OTP.',
            ]);
        }

        // OTP is valid, delete it
        $record->delete();

        $user = User::find($user_id);
        session()->forget('otp_user_id');
        session()->forget('remember');

        Auth::login($user, $remember);
        request()->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Resend OTP
     */
    public function resend(Request $request)
    {
        $user_id = session('otp_user_id');

        if (! $user_id) {
            abort(403, 'Unauthorized.');
        }

        $user = User::find($user_id);

        if (! $user) {
            abort(404, 'User not found.');
        }

        // Generate new OTP
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete existing OTP & save new
        UserOtp::where('user_id', $user->id)->delete();

        UserOtp::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp' => Hash::make($otp),
                'expires_at' => Carbon::now()->addMinutes(5)
            ]
        );

        // Send OTP via mail
        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('otp.show')->with('status', 'A new OTP has been sent to your email.');
    }
}
