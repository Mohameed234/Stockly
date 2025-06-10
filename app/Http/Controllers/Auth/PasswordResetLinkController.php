<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        Log::info('Password reset link requested', [
            'email' => $request->email
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            Log::warning('Password reset requested for non-existent user', [
                'email' => $request->email
            ]);
            return back()->with('status', 'If your email is registered, you will receive a password reset link.');
        }

        // Delete any existing tokens for this email
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Generate a new token
        $token = Str::random(64);

        // Store the token in the database
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Generate the reset URL with both token and email
        $resetUrl = route('password.reset', [
            'token' => $token,
            'email' => $request->email
        ]);

        // Send the email
        try {
            Mail::send('emails.reset-password', ['url' => $resetUrl], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Reset Password Notification');
            });

            Log::info('Password reset email sent', [
                'email' => $request->email,
                'token' => $token
            ]);

            return back()->with('status', 'We have emailed your password reset link!');
        } catch (\Exception $e) {
            Log::error('Failed to send password reset email', [
                'email' => $request->email,
                'error' => $e->getMessage()
            ]);

            return back()->withErrors(['email' => 'Failed to send reset link. Please try again.']);
        }
    }
}
