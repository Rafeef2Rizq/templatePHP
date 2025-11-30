<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;
            $exclodeField = ['password', 'confirmPassword'];
            $formattedData = array_diff_key($oldFormData, array_flip($exclodeField));
            $_SESSION['errors'] = $e->getErrors();
            $_SESSION['oldForm'] = $formattedData;
            $referer = $_SERVER['HTTP_REFERER'];
            redirectTo($referer);
        }
    }
}
