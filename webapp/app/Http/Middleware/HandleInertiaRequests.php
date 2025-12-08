<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        $can = [];

        if ($user) {
            // Get all permissions (cached for 1 hour)
            $allPermissions = Cache::remember('permissions_list', 3600, function () {
                return Permission::all()->pluck('code');
            });

            // If user is admin, grant all permissions
            if ($user->isAdmin()) {
                $can = $allPermissions->mapWithKeys(function ($permissionCode) {
                    return [$permissionCode => true];
                })->all();
            } else {
                // Get user permissions (eager loaded for performance)
                $userPermissions = $user->roles()->with('permissions')->get()->flatMap(function ($role) {
                    return $role->permissions;
                })->pluck('code');

                // Map all permissions and check if the user has each one
                $can = $allPermissions->mapWithKeys(function ($permissionCode) use ($userPermissions) {
                    return [$permissionCode => $userPermissions->contains($permissionCode)];
                })->all();
            }
        }

        $locale = App::getLocale();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'can' => $can,
            ],
            'csrf_token' => $request->session()->token(),
            'locale' => $locale,
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
