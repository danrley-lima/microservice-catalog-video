<?php

namespace Tests\Unit\App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


abstract class ModelTestCase extends TestCase {
  protected abstract function model(): Model;
  protected abstract function traits(): array;
  protected abstract function fillabres(): array;
  protected abstract function casts(): array;

  public function testIfUseTraits() {
    $traitsNeed = $this->traits();
    $traitsUsed = array_keys(class_uses($this->model()));
    $this->assertEquals($traitsNeed, $traitsUsed);
  }

  public function testFillables() {
    $expectedFillables = $this->fillabres();
    $fillables = $this->model()->getFillable();

    $this->assertEquals($expectedFillables, $fillables);
  }

  public function testIncrementingIsFalse() {
    $model = $this->model();
    $this->assertFalse($model->incrementing);
  }

  public function testHasCasts() {
    $expectedCasts = $this->casts();
    $casts = $this->model()->getCasts();

    $this->assertEquals($expectedCasts, $casts);
  }
}
