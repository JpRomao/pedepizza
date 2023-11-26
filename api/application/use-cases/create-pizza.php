<?php

namespace Application\UseCases;

use Application\Entities\Pizza;
use Application\Repositories\PizzasIngredientsRepository;
use Application\Repositories\PizzasRepository;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

class CreatePizzaUseCase
{
  public function __construct(private PizzasRepository $pizzasRepository, private PizzasIngredientsRepository $pizzasIngredientsRepository)
  {
  }

  public function execute(string $name, string $image, int $createdBY, array $ingredients)
  {
    $props = array(
      'name' => $name,
      'image' => $image,
      'created_by' => $createdBY,
      'ingredients' => $ingredients
    );

    $pizza = Pizza::create($props, null);

    $this->pizzasRepository->create($pizza);

    foreach ($pizza->getIngredients() as $ingredient) {
      $this->pizzasIngredientsRepository->create($pizza->getId(), $ingredient->getId());
    }

    return $pizza;
  }
}
