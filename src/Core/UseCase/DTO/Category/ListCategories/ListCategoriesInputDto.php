<?php

namespace Core\UseCase\DTO\Category\ListCategories;

class ListCategoriesInputDto {
  // string $filter = "", $order = "DESC", int $page = 1, int $totalPage = 15
  public function __construct(
    public string $filter = "",
    public string $order = "DESC",
    public int $page = 1,
    public int $totalPage = 15,
  ) {
  }
}
