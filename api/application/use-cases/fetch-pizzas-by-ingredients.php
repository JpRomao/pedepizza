<?php

namespace Application\UseCases;

use Application\Repositories\PizzasIngredientsRepository;

class FetchPizzasByIngredientsUseCase
{
  public function __construct(private PizzasIngredientsRepository $pizzasIngredientsRepository)
  {
  }

  public function execute(array $ingredients, int $page = 1)
  {
    $pizzas = $this->pizzasIngredientsRepository->findManyByIngredients($ingredients, $page) ?? [];

    $pizzas = array_map(function ($pizza) {
      $pizza['ingredients'] = explode(',', $pizza['ingredients']);
      $pizza['timeToPrepare'] = $pizza['time_to_prepare'];

      unset($pizza['time_to_prepare']);

      return $pizza;
    }, $pizzas);

    return $pizzas;
  }
}
