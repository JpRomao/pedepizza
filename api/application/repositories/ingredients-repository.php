<?php

namespace Application\Repositories;

use Application\Entities\Ingredient;

interface IngredientsRepository
{
  public function findMany(int $page): array | null;
  public function create(Ingredient $ingredient): void;
  public function findByName(string $name): Ingredient | null;
}
