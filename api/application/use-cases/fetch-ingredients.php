<?php

namespace Application\UseCases;

use Application\Repositories\IngredientsRepository;

class FetchIngredientsUseCase
{
  public function __construct(private IngredientsRepository $repository)
  {
  }

  public function execute(int $page = 1)
  {
    $ingredients = $this->repository->findMany($page) ?? [];

    return $ingredients;
  }
}
