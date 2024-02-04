<?php

namespace Tests\Unit\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\CategoryOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ListCategoryUseCaseUnitTest extends TestCase {

  public function testFindById() {
    $id = (string) Uuid::uuid4()->toString();
    $this->mockEntity = Mockery::mock(Category::class, [
      $id,
      'test category',
    ]);
    $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));


    $this->mockRepository = Mockery::mock(CategoryRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findById')
      ->with($id)
      ->andReturn($this->mockEntity);

    $this->mockInputDto = Mockery::mock(CategoryInputDto::class, [
      $id,
    ]);

    $useCase = new ListCategoryUseCase($this->mockRepository);
    $responseUseCase = $useCase->execute($this->mockInputDto);
    $this->assertInstanceOf(CategoryOutputDto::class, $responseUseCase);
    $this->assertEquals($id, $responseUseCase->id);
    $this->assertEquals("test category", $responseUseCase->name);

    /**
     * Spies
     */
    $this->spy = Mockery::spy(CategoryRepositoryInterface::class);
    $this->spy->shouldReceive('findById')
      ->with($id)
      ->andReturn($this->mockEntity);
    $useCase = new ListCategoryUseCase($this->spy);
    $responseUseCase = $useCase->execute($this->mockInputDto);
    $this->spy->shouldHaveReceived('findById');
  }

  protected function tearDown(): void {
    Mockery::close();
    parent::tearDown();
  }
}
