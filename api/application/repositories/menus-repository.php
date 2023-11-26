<?php

namespace Application\Repositories;

use Application\Entities\Pizzeria;

interface MenusRepository
{
  public function findPizzeriaByPizza(string $pizzaId): Pizzeria | null;
}
