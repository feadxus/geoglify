<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt database authentication.
     */
    protected function attemptDatabaseAuthentication(array $credentials): bool
    {
        // Validate credentials without logging the user in so we can require
        // a one-time password (OTP) for new sessions. If the password is
        // correct, send an OTP and mark the session as pending verification.

        $user = User::where('email', $credentials['email'] ?? null)->first();

        if (! $user) {
            return false;
        }

        if (! Hash::check($credentials['password'] ?? '', $user->password)) {
            return false;
        }

        // Password is valid — send OTP and store pending email in session.
        // The actual login will happen after successful OTP verification.
        try {
            $user->sendOneTimePassword();
        } catch (\Throwable $e) {
            // If sending OTP fails, log the error and deny authentication.
            // Let the normal authentication flow treat this as a failure.
            report($e);
            return false;
        }

        session()->put('otp.pending_email', $user->email);

        return true;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('email', 'password');

        if ($this->attemptDatabaseAuthentication($credentials)) {
            $this->clearRateLimiter();

            return;
        }

        $this->incrementRateLimiter();

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Clear the rate limiter for the current request.
     */
    protected function clearRateLimiter(): void
    {
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Increment the rate limiter for the current request.
     */
    protected function incrementRateLimiter(): void
    {
        RateLimiter::hit($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
