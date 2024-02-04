<?php

namespace Tests\Unit\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\DeleteCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\DeleteCategory\DeleteCategoryOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class DeleteCategoryUseCaseUnitTest extends TestCase {

  public function testDelete() {
    $uuid = (string) Uuid::uuid4()->toString();

    $this->mockEntity = Mockery::mock(Category::class, [
      $uuid,
      'Category Name',
    ]);

    $this->mockRepository = Mockery::mock(CategoryRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findById')->andReturn($this->mockEntity);
    $this->mockRepository->shouldReceive('delete')->andReturn(true);

    $this->mockInputDto = Mockery::mock(CategoryInputDto::class, [
      $uuid
    ]);

    $useCase = new DeleteCategoryUseCase($this->mockRepository);
    $responseUseCase = $useCase->execute($this->mockInputDto);

    $this->assertInstanceOf(DeleteCategoryOutputDto::class, $responseUseCase);
    $this->assertTrue($responseUseCase->success);

    /**
     * Spies
     */
    $this->spy = Mockery::spy(CategoryRepositoryInterface::class);
    $this->spy->shouldReceive('delete')->andReturn(true);
    $useCase = new DeleteCategoryUseCase($this->spy);
    $responseUseCase = $useCase->execute($this->mockInputDto);
    $this->spy->shouldHaveReceived('delete');
  }

  public function testDeleteFalse() {
    $uuid = (string) Uuid::uuid4()->toString();

    $this->mockEntity = Mockery::mock(Category::class, [
      $uuid,
      'Category Name',
    ]);

    $this->mockRepository = Mockery::mock(CategoryRepositoryInterface::class);
    $this->mockRepository->shouldReceive('findById')->andReturn($this->mockEntity);
    $this->mockRepository->shouldReceive('delete')->andReturn(false);

    $this->mockInputDto = Mockery::mock(CategoryInputDto::class, [
      $uuid
    ]);

    $useCase = new DeleteCategoryUseCase($this->mockRepository);
    $responseUseCase = $useCase->execute($this->mockInputDto);

    $this->assertInstanceOf(DeleteCategoryOutputDto::class, $responseUseCase);
    $this->assertFalse($responseUseCase->success);
  }

  protected function tearDown(): void {
    Mockery::close();
    parent::tearDown();
  }
}
