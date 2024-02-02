<?php

namespace Tests\Unit\Domain\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use App\Core\Domain\Repository\PaginationInterface;
use Core\UseCase\Category\ListCategoriesUseCase;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListCategoriesUseCaseUnitTest extends TestCase {

  public function testListCategoriesEmpty() {
    $this->mockPagination = Mockery::mock(PaginationInterface::class);
    $this->mockPagination->shouldReceive('items')->andReturn([]);
    $this->mockPagination->shouldReceive('total')->andReturn(0);

    $this->mockRepository = Mockery::mock(CategoryRepositoryInterface::class);

    $this->mockRepository->shouldReceive('paginate')->andReturn($this->mockPagination);

    $this->mockInputDto = Mockery::mock(ListCategoriesInputDto::class, [
      'filter',
      'order',
    ]);

    $useCase = new ListCategoriesUseCase($this->mockRepository);
    $responseUseCase = $useCase->execute($this->mockInputDto);

    $this->assertCount(0, $responseUseCase->items);
    $this->assertInstanceOf(ListCategoriesOutputDto::class, $responseUseCase);
  }
}
