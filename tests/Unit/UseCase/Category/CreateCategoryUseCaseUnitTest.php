<?php

namespace Tests\Unit\Domain\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CategoryCreateOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateCategoryUseCaseUnitTest extends TestCase {

  public function testCreateNewCategory() {

    $uuid = (string) Uuid::uuid4()->toString();
    $categoryName = "Category Name";

    $this->mockEntity = Mockery::mock(
      Category::class,
      [
        $uuid,
        $categoryName
      ]
    );

    $this->mockEntity->shouldReceive('id')->andReturn($uuid);
    // $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
    $this->mockRepository = Mockery::mock(CategoryRepositoryInterface::class);
    $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);

    $this->mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [
      $uuid,
      $categoryName,
    ]);

    $useCase = new CreateCategoryUseCase($this->mockRepository);
    $responseUseCase = $useCase->execute($this->mockInputDto);

    $this->assertInstanceOf(CategoryCreateOutputDto::class, $responseUseCase);
    $this->assertEquals($uuid, $responseUseCase->id);
    $this->assertEquals($categoryName, $responseUseCase->name);
    $this->assertEquals("", $responseUseCase->description);

    /**
     * Spies
     */
    $this->spy = Mockery::spy(CategoryRepositoryInterface::class);
    $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);
    $useCase = new CreateCategoryUseCase($this->spy);
    $responseUseCase = $useCase->execute($this->mockInputDto);
    $this->spy->shouldHaveReceived("insert");
  }

  protected function tearDown(): void {
    Mockery::close();
    parent::tearDown();
  }
}
