<?php

namespace App\Observers;

use App\Models\Pet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PetObserver
{
    public function created(Pet $pet): void
    {
        Log::info('Pet created. Changes: ', $pet->getChanges());
        Cache::flush();
    }

    public function updated(Pet $pet): void
    {
        Log::info('Pet updated. Changes: ', $pet->getChanges());
        Cache::flush();
    }

    public function deleting(Pet $pet): void
    {
        if ($pet->cover && Storage::disk('public')->exists($pet->cover)) {
            Storage::disk('public')->delete($pet->cover);
        }

        if ($pet->attachment && Storage::disk('local')->exists($pet->attachment)) {
            Storage::disk('local')->delete($pet->attachment);
        }
        
        Cache::flush();
    }
}
