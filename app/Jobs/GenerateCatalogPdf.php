<?php

namespace App\Jobs;

use App\Models\Pet;
use App\Models\User;
use App\Notifications\ExportReady;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateCatalogPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected User $user)
    {
    }

    public function handle(): void
    {

        $items = Pet::with('owner')->latest()->get();

        $pdf = Pdf::loadView('pdf.catalog', compact('items'));

        $filename = 'catalog_' . Str::random(8) . '.pdf';
        $directory = 'exports';
        $path = $directory . '/' . $filename;

        if (!Storage::disk('local')->exists($directory)) {
            Storage::disk('local')->makeDirectory($directory);
        }
        Storage::disk('local')->put($path, $pdf->output());

        $this->user->notify(new ExportReady($filename));
    }
}
