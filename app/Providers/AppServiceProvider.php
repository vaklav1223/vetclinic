<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
        DB::enableQueryLog();
        Paginator::defaultView('pagination::semantic-ui');
    }


}
