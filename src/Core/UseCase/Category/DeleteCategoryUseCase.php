<?php

namespace Core\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\CategoryInputDto;
use Core\UseCase\DTO\Category\DeleteCategory\DeleteCategoryOutputDto;

class DeleteCategoryUseCase {
  protected $repository;

  public function __construct(CategoryRepositoryInterface $repository) {
    $this->repository = $repository;
  }

  public function execute(CategoryInputDto $input): DeleteCategoryOutputDto {
    $category = $this->repository->findById($input->id);

    $responseDelete = $this->repository->delete($input->id);

    return new DeleteCategoryOutputDto(
      success: $responseDelete
    );
  }
}
