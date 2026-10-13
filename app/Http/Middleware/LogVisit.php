<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info("Визит: " . $request->fullUrl());
        $logMessage = "[" . date('Y-m-d H:i:s') . "] local.INFO: Визит: " . $request->fullUrl() . PHP_EOL;
        file_put_contents(storage_path('logs/laravel.log'), $logMessage, FILE_APPEND);

        return $next($request);
    }
}
