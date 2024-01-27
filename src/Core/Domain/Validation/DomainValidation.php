<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation {
  public static function notNull(string $value, string $exceptMessage = null) {
    if (empty($value)) {
      throw new EntityValidationException($exceptMessage ?? "Value cannot be null");
    }
  }

  public static function strMaxlength(string $value, int $length = 255, string $exceptMessage = null) {
    if (strlen($value) >= $length) {
      throw new EntityValidationException($exceptMessage ?? "Value cannot be greater than {$length} characters");
    }
  }

  public static function strMinlength(string $value, int $length = 3, string $exceptMessage = null) {
    if (strlen($value) < $length) {
      throw new EntityValidationException($exceptMessage ?? "Value cannot be lesser than {$length} characters");
    }
  }

  public static function strCanNullAndMaxLength(string $value = "", int $length = 255, string $exceptMessage = null) {
    if (!empty($value) && strlen($value) > $length) {
      throw new EntityValidationException($exceptMessage ?? "Value cannot be greater than {$length} characters");
    }
  }
}
