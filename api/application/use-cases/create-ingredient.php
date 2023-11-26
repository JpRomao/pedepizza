<?php

namespace Application\UseCases;

use Application\Entities\Ingredient;
use Application\Repositories\IngredientsRepository;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

class CreateIngredientUseCase
{
  public function __construct(private IngredientsRepository $ingredientsRepository)
  {
  }

  public function execute(string $name, string $image)
  {
    $props = array(
      'name' => $name,
      'image' => $image
    );

    $ingredient = Ingredient::create($props, null);

    $this->ingredientsRepository->create($ingredient);
  }
}
