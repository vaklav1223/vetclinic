<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Pet;
use App\Models\Owner;
use App\Observers\PetObserver;
use App\Observers\OwnerObserver;
use App\Contracts\SmsSender;
use App\Services\LogSmsSender;
use App\Services\NullSmsSender;
use App\Events\BookingCreated;
use App\Listeners\SendBookingConfirmation;
use App\Listeners\NotifyAdminsAboutBooking;
use App\Listeners\SendBookingSms;
use Illuminate\Support\Facades\Event;

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

        Event::listen(BookingCreated::class, [SendBookingConfirmation::class, 'handle']);
        Event::listen(BookingCreated::class, [NotifyAdminsAboutBooking::class, 'handle']);
        Event::listen(BookingCreated::class, [SendBookingSms::class, 'handle']);

        Pet::observe(PetObserver::class);
        Owner::observe(OwnerObserver::class);
    }
}
