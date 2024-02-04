<?php

namespace Core\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\UpdateCategory\UpdateCategoryInputDto;
use Core\UseCase\DTO\Category\UpdateCategory\UpdateCategoryOutputDto;

class UpdateCategoryUseCase {
  protected $repository;
  public function __construct(CategoryRepositoryInterface $repository) {
    $this->repository = $repository;
  }

  public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto {
    $category = $this->repository->findById($input->id);

    $category->update(
      name: $input->name,
      description: $input->description ?? $category->description
    );

    $updatedCategory = $this->repository->update($category);

    return new UpdateCategoryOutputDto(
      id: $updatedCategory->id,
      name: $updatedCategory->name,
      description: $updatedCategory->description,
      isActive: $updatedCategory->isActive,
      created_at: $updatedCategory->createdAt(),
    );
  }
}
