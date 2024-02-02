<?php

namespace Tests\Unit\Domain\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use App\Core\Domain\Repository\PaginationInterface;
use Core\UseCase\Category\ListCategoriesUseCase;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListCategoriesUseCaseUnitTest extends TestCase {

  public function testListCategoriesEmpty() {
    $mockPagination = $this->mockPagination();

    $this->mockRepository = Mockery::mock(CategoryRepositoryInterface::class);

    $this->mockRepository->shouldReceive('paginate')->andReturn($mockPagination);

    $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, [
      'filter',
      'order',
    ]);

    $useCase = new ListCategoriesUseCase($this->mockRepository);
    $responseUseCase = $useCase->execute($this->mockInputDto);

    $this->assertCount(0, $responseUseCase->items);
    $this->assertInstanceOf(ListCategoriesOutputDto::class, $responseUseCase);
  }

  protected function mockPagination() {
    $this->mockPagination = Mockery::mock(PaginationInterface::class);
    $this->mockPagination->shouldReceive('items')->andReturn([]);
    $this->mockPagination->shouldReceive('total')->andReturn(0);
    $this->mockPagination->shouldReceive('lastPage')->andReturn(0);
    $this->mockPagination->shouldReceive('firstPage')->andReturn(0);
    $this->mockPagination->shouldReceive('perPage')->andReturn(0);
    $this->mockPagination->shouldReceive('to')->andReturn(0);
    $this->mockPagination->shouldReceive('from')->andReturn(0);

    return $this->mockPagination;
  }

  protected function tearDown(): void {
    Mockery::close();
    parent::tearDown();
  }
}
