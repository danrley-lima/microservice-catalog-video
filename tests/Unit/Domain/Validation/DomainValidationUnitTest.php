<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase {
  public function testNotNull() {
    try {
      $value = "";
      DomainValidation::notNull($value);

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }

  public function testNotNullCustomMessageException() {
    try {
      $value = "";
      DomainValidation::notNull($value, "custom message error");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th, "custom message error");
    }
  }

  public function testStrMaxLength() {
    try {
      $value = "Teste";
      DomainValidation::strMaxlength($value, 5, "Custom Message Error");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th, "Custom Message Error");
    }
  }

  public function testStrMinLength() {
    try {
      $value = "Test";
      DomainValidation::strMinlength($value, 8, "Custom Message Error");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th, "Custom Message Error");
    }
  }

  public function testStrCanNullAndMaxLength() {
    try {
      $value = "teste";
      DomainValidation::strCanNullAndMaxLength($value, 3, "Custom Message Error");

      $this->assertTrue(false);
    } catch (Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th, "Custom Message Error");
    }
  }
}
