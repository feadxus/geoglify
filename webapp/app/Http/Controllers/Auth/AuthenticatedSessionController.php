<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'appName' => config('app.name'),
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // If authentication set a pending OTP (we validated the password
        // but did not log the user in yet), redirect user to the OTP
        // verification flow instead of completing the login.
        $pendingEmail = $request->session()->pull('otp.pending_email');

        if ($pendingEmail) {
            // Regenerate session to avoid fixation but keep OTP pending state
            // cleared (we pulled it) — the OTP verification will log the user in.
            $request->session()->regenerate();

            return redirect()->route('login.otp.verify', ['email' => $pendingEmail]);
        }

        $request->session()->regenerate();

        return redirect('/');
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
