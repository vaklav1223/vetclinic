<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $configKey = env('ADMIN_KEY');

        if (empty($configKey)) {
            abort(403, 'Нужен ключ администратора (ключ не задан в .env)');
        }

        if ($request->query('key') === $configKey) {
            $request->session()->put('is_admin', true);
            return $next($request);
        }

        if ($request->session()->get('is_admin') === true) {
            return $next($request);
        }

        abort(403, 'Нужен ключ администратора');
    }
}
