<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production' || env('APP_ENV') === 'staging') {
            URL::forceScheme('https');
        }

        try {
            foreach (Permission::pluck('code') as $permissionCode) {
                Gate::define($permissionCode, function ($user) use ($permissionCode) {
                    return $user->roles()->whereHas('permissions', function ($q) use ($permissionCode) {
                        $q->where('code', $permissionCode);
                    })->count() > 0;
                });
            }
        } catch (\Exception $e) {
            Log::info('registerUserAccessToGates: Database not found or not yet migrated. Ignoring user permissions while booting app.');
        }
    }
}
