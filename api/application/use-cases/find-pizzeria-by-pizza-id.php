<?php

namespace Application\UseCases;

use Application\Repositories\MenusRepository;
use Application\Repositories\PizzasRepository;

class FindPizzeriaByPizzaIdUseCase
{
  public function __construct(private MenusRepository $repository, private PizzasRepository $pizzasRepository)
  {
  }

  public function execute(string $pizzaId)
  {
    $pizza = $this->pizzasRepository->findOne($pizzaId);

    if (!$pizza) {
      return null;
    }

    $pizzeria = $this->repository->findPizzeriaByPizza($pizzaId);

    if (!$pizzeria) {
      return null;
    }

    return array(
      'pizzeria' => $pizzeria->toArray(),
      'pizza' => $pizza->toArray()
    );
  }
}
