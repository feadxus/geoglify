<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\OneTimePasswords\Enums\ConsumeOneTimePasswordResult;

class OneTimePasswordController extends Controller
{
    /**
     * Display the view to request a one-time password.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/LoginWithOtp');
    }

    /**
     * Send the one-time password to the user.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->sendOneTimePassword();
        }

        // Always redirect to the verify page to prevent user enumeration
        return redirect()->route('login.otp.verify', ['email' => $request->email]);
    }

    /**
     * Display the view to enter the one-time password.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Auth/VerifyOtp', [
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Consume the one-time password and log the user in.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'otp' => __('The provided one-time password is not valid.'),
            ]);
        }

        $result = $user->consumeOneTimePassword($request->otp);

        if ($result === ConsumeOneTimePasswordResult::Ok) {
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard', absolute: false));
        }

        throw ValidationException::withMessages([
            'otp' => match ($result) {
                ConsumeOneTimePasswordResult::OneTimePasswordExpired => __('The one-time password has expired.'),
                default => __('The provided one-time password is not valid.'),
            },
        ]);
    }
}
