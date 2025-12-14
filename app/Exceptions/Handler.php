<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Handler extends ExceptionHandler
{
    // ...

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Логируем только 403, 404, 500, 503
            if (in_array($status, [403, 404, 500, 503])) {
                Log::warning('Ошибка '.$status.': '.$e->getMessage(), [
                    'url' => request()->fullUrl(),
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'method' => request()->method(),
                    'ip' => request()->ip(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        });
    }
}
