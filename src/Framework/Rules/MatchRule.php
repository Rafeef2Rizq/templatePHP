<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class MatchRule implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
        $fieldPass = $formData[$field];
        $fieldPassCon = $formData[$params[0]];
        return $fieldPass === $fieldPassCon;
    }
    public function getMessage(array $formData, string $field, array $params): string
    {
        return "Does not match {$params[0]} field";
    }
}
