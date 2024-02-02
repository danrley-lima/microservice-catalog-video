<?php

namespace Core\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategories\ListCategoriesOutputDto;

class ListCategoriesUseCase {
  public function __construct(CategoryRepositoryInterface $repository) {
    $this->repository = $repository;
  }

  public function execute(ListCategoriesInputDto $input): ListCategoriesOutputDto {
    $categories = $this->repository->paginate(
      filter: $input->filter,
      order: $input->order,
      page: $input->page,
      totalPage: $input->totalPage
    );

    return new ListCategoriesOutputDto(
      items: $categories->items(),
      total: $categories->total(),
    );
  }
}
