<?php

namespace Application\Repositories;

use Application\Entities\Pizza;

interface PizzasRepository
{
  public function findOne(string $id): Pizza | null;
  public function findMany(int $page): array | null;
  public function create(Pizza $pizza): void;
}
