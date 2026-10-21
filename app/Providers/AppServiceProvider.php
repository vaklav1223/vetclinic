<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Contracts\SmsSender;
use App\Services\LogSmsSender;
use App\Services\NullSmsSender;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SmsSender::class, function ($app) {
            $driver = config('services.sms.driver');

            if ($driver === 'log') {
                return new LogSmsSender();
            }

            return new NullSmsSender();
        });
    }
    public function boot(): void
    {
        Gate::define('admin-panel', function (User $user) {
            return in_array($user->role, ['admin', 'editor']);
        });
    }
}
