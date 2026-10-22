<?php

namespace App\Observers;

use App\Models\Owner;
use Illuminate\Support\Facades\Cache;

class OwnerObserver
{
    public function saved(Owner $owner): void
    {
        Cache::forget('genres.menu');
    }

    public function deleted(Owner $owner): void
    {
        Cache::forget('genres.menu');
    }
}
