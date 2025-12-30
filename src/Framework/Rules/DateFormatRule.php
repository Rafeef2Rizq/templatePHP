<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class DateFormatRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
    $parsedDate= date_parse_from_format($params[0],$formData[$field]);
    return $parsedDate['error_count']===0 && $parsedDate['warning_count'] ===0;
    }
    public function getMessage(array $formData, string $filed, array $params): string
    {
        return "Invalid date";
    }
}
