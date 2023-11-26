<?php

namespace Application\Repositories;

interface PizzasIngredientsRepository
{
  public function create(string $pizzaId, array $ingredientsId): void;
  // public function delete(string $pizzaId, string $ingredientId): void;
  public function findManyByIngredients(array $ingredientsIds, int $page): array;
}
