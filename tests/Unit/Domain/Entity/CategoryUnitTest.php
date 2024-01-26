<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase {
  public function testeAttributes() {
    $category = new Category(
      name: "Category Test",
      description: "Description Test",
      isActive: true
    );

    $this->assertEquals("Category Test", $category->name);
    $this->assertEquals("Description Test", $category->description);
    $this->assertEquals(true, $category->isActive);
  }

  public function testActiveted() {
    $category = new Category(
      name: "Category Test",
      isActive: false
    );

    $this->assertFalse($category->isActive);
    $category->activate();
    $this->assertTrue($category->isActive);
  }

  public function testDisabled() {
    $category = new Category(
      name: "Category Test",
    );

    $this->assertTrue($category->isActive);
    $category->desable();
    $this->assertFalse($category->isActive);
  }
}
