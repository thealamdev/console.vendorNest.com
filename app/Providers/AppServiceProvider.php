<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\Enums\UserType;

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
        Gate::define('canAccess', function (User $user) {
            return $user->type !== UserType::BUYER->value;
        });

        Broadcast::routes(['prefix' => 'api', 'middleware' => ['auth:sanctum']]);
    }
}
