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

    // return new ListCategoriesOutputDto(
    //   items: array_map(function ($data) {
    //     var_dump($data);
    //     return [
    //       'id' => $data->id,
    //       'name' => $data->name,
    //       'description' => $data->description,
    //       'is_active' => $data->is_active,
    //       'created_at' => $data->created_at,
    //       'updated_at' => $data->updated_at,
    //       'deleted_at' => $data->deleted_at,
    //     ];
    //   }, $categories->items() ?? []),
    //   total: $categories->total(),
    //   last_page: $categories->lastPage(),
    //   first_page: $categories->firstPage(),
    //   per_page: $categories->perPage(),
    //   to: $categories->to(),
    //   from: $categories->from(),
    // );

    return new ListCategoriesOutputDto(
      items: $categories->items(),
      total: $categories->total(),
      last_page: $categories->lastPage(),
      first_page: $categories->firstPage(),
      per_page: $categories->perPage(),
      to: $categories->to(),
      from: $categories->from(),
    );
  }
}
