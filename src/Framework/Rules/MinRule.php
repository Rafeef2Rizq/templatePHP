<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class MinRule  implements RuleInterface
{
    public function validate(array $formData, string $filed, array $params): bool
    {
        if (empty($params[0])) {
            throw new InvalidArgumentException("Minmum length not specified");
        }
        $length = (int) $params[0];
        return $formData[$filed] >= $length;
    }
    public function getMessage(array $formData, string $filed, array $params): string
    {
        return "Must be at least {$params[0]}";
    }
}
