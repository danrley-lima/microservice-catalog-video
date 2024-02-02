<?php

namespace Core\UseCase\Category;

use App\Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\UpdateCategoryInputDto;
use Core\UseCase\DTO\Category\UpdateCategoryOutputDto;

class UpdateCategoryUseCase {
  protected $repository;
  public function __construct(CategoryRepositoryInterface $repository) {
    $this->repository = $repository;
  }

  public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto {
    // var_dump(get_object_vars($input));
    $category = $this->repository->findById($input->id);

    var_dump(get_object_vars($category));

    $category->update(
      name: $input->name,
      description: $input->description ?? $category->description
    );

    $updatedCategory = $this->repository->update($category);

    return new UpdateCategoryOutputDto(
      id: $updatedCategory->id,
      name: $updatedCategory->name,
      description: $updatedCategory->description,
      isActive: $updatedCategory->isActive
    );
  }
}
