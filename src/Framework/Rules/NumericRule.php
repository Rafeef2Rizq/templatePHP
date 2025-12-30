<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class NumericRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
     return is_numeric($formData[$field]);
    }
    public function getMessage(array $formData, string $filed, array $params): string
    {
        return "Only numbers allowed";
    }
}
