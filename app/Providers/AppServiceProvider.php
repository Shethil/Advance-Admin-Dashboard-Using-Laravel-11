<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
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
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->permission_slug, function ($user) use ($permission) {
                Log::info('Checking permission gate', [
                    'user_id' => $user->id,
                    'permission' => $permission->permission_slug,
                ]);
                return $user->hasPermission($permission->permission_slug)
                ? \Illuminate\Auth\Access\Response::allow()
                : \Illuminate\Auth\Access\Response::denyAsNotFound();
            });
        }

        Log::info('Gates defined', ['gates' => Gate::abilities()]);

    }
}
