<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class LengthMaxRule implements RuleInterface
{
  public function validate(array $formData, string $field, array $params): bool
  {
    if (empty($params[0])) {
      throw new InvalidArgumentException('Maximum length not specified');
    }
    $length = (int) $params[0];
    return strlen($formData[$field]) < $length;
  }
  public function getMessage(array $formData, string $filed, array $params): string
  {
    return "Exceeds maximum character limit of {$params[0]} chars";
  }
}
