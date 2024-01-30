<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CategoryUnitTest extends TestCase {
  public function testAttributes() {
    $category = new Category(
      name: "Category Test",
      description: "Description Test",
      isActive: true
    );

    $this->assertNotEmpty($category->createdAt());
    $this->assertNotEmpty($category->id());
    $this->assertEquals("Category Test", $category->name);
    $this->assertEquals("Description Test", $category->description);
    $this->assertEquals(true, $category->isActive);
  }

  public function testActivated() {
    $category = new Category(
      name: "Category Test",
      description: "Description Test",
      isActive: false
    );

    $this->assertFalse($category->isActive);
    $category->activate();
    $this->assertTrue($category->isActive);
  }

  public function testDisabled() {
    $category = new Category(
      name: "Category Test",
      description: "Description Test",
    );

    $this->assertTrue($category->isActive);
    $category->disable();
    $this->assertFalse($category->isActive);
  }

  public function testUpdate() {
    $uuid = (string) Uuid::uuid4()->toString();

    $category = new Category(
      id: $uuid,
      name: "Category Test",
      description: "Description Test",
      isActive: true,
      createdAt: "2023-01-01 12:12:12"
    );

    $category->update(
      name: "new_name",
      description: "new_description",
    );

    $this->assertEquals($uuid, $category->id());
    $this->assertEquals("new_name", $category->name);
    $this->assertEquals("new_description", $category->description);
  }

  public function testExceptionName() {
    try {
      new Category(
        name: "Na",
        description: "New Description",
      );

      $this->assertTrue(false);
    } catch (\Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }

  public function testExceptionDescription() {
    try {
      new Category(
        name: "New Name",
        description: random_bytes(9999),
      );

      $this->assertTrue(false);
    } catch (\Throwable $th) {
      $this->assertInstanceOf(EntityValidationException::class, $th);
    }
  }
}
