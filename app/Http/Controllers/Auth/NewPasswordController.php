<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request)
    {
        $token = $request->route('token');
        $email = $request->query('email');

        Log::info('Password reset view accessed', [
            'token' => $token,
            'email' => $email
        ]);

        if (!$email) {
            Log::warning('Password reset accessed without email parameter');
            return redirect()->route('password.request')
                ->with('error', 'Invalid password reset link. Please request a new one.');
        }

        return view('auth.reset-password', [
            'request' => $request,
            'email' => $email
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        Log::info('Password reset attempt', [
            'email' => $request->email
        ]);

        // Find the token in the database
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$tokenData) {
            Log::warning('Invalid or expired reset token', [
                'email' => $request->email
            ]);
            return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        }

        // Check if token is expired (60 minutes)
        if (now()->diffInMinutes($tokenData->created_at) > 60) {
            Log::warning('Expired reset token', [
                'email' => $request->email,
                'created_at' => $tokenData->created_at
            ]);
            return back()->withErrors(['email' => 'Reset token has expired.']);
        }

        // Find the user
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            Log::warning('User not found for password reset', [
                'email' => $request->email
            ]);
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Update the password
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        // Delete the used token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        Log::info('Password reset successful', [
            'email' => $request->email
        ]);

        return redirect()->route('login')->with('status', 'Your password has been reset successfully!');
    }
}
