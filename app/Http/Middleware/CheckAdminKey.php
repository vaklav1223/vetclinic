<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminKey
{
    public function handle(Request $request, Closure $next): Response
    {
        // Читаем напрямую из .env, чтобы обойти проблемы с кэшем конфигурации
        $configKey = env('ADMIN_KEY');

        if (empty($configKey)) {
            abort(403, 'Нужен ключ администратора (ключ не задан в .env)');
        }

        // Если ключ передан прямо сейчас в ссылке — сразу даем доступ и пишем в сессию
        if ($request->query('key') === $configKey) {
            $request->session()->put('is_admin', true);
            return $next($request);
        }

        // Если ключа в ссылке нет, но мы уже заходили ранее (флаг есть в сессии) — пропускаем
        if ($request->session()->get('is_admin') === true) {
            return $next($request);
        }

        // Во всех остальных случаях — доступ закрыт
        abort(403, 'Нужен ключ администратора');
    }
}
