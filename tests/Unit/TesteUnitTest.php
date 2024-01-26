<?php

namespace Tests\Unit;

use Core\Teste;
use PHPUnit\Framework\TestCase;

class TesteUnitTest extends TestCase {
  public function testCallMethodFoo() {
    $teste = new Teste();
    $response = $teste->foo();

    $this->assertEquals("1234", $response);
  }
}
