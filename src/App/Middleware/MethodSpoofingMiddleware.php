<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class MethodSpoofingMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        // تحويل POST مع _METHOD إلى HTTP method المطلوب
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_METHOD'])) {
            $method = strtoupper($_POST['_METHOD']);

            // السماح فقط بـ PUT, PATCH, DELETE
            if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
                $_SERVER['REQUEST_METHOD'] = $method;
            }
        }

        $next();
    }
}