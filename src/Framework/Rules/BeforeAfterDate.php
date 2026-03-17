<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class BeforeAfterDate implements RuleInterface
{
    public function validate(array $formData, string $field, array $params): bool
    {
        $otherField = $params[0] ?? null;

        if (!$otherField || empty($formData[$field]) || empty($formData[$otherField])) {
            return true;
        }

        $current = new \DateTime($formData[$field]);
        $other = new \DateTime($formData[$otherField]);

        return $current > $other;
    }

    public function getMessage(array $formData, string $field, array $params): string
    {
        return 'End date must be after start date';
    }
}
