<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OrchidAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Проверяем, что пользователь авторизован
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Проверяем, что это АДМИН
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Только для администраторов');
        }

        // 3. Проверяем, что у админа есть EMAIL (для входа в Orchid)
        if (empty(auth()->user()->email)) {
            abort(403, 'Администратор должен иметь email для доступа к панели');
        }

        return $next($request);
    }
}
