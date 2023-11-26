<?php

namespace Infra\Database\Repositories;

use Application\Entities\Ingredient;
use Application\Repositories\IngredientsRepository;
use PDO;

class MysqlIngredientsRepository implements IngredientsRepository
{
  public function __construct(private PDO $db)
  {
  }

  public function findMany(int $page): ?array
  {
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $stmt = $this->db->prepare('SELECT id, name, image FROM ingredients ORDER BY name LIMIT :limit OFFSET :offset');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$ingredients) {
      return null;
    }

    return $ingredients;
  }

  public function create(Ingredient $ingredient): void
  {
    $stmt = $this->db->prepare('INSERT INTO ingredients (id, name, image) VALUES (:id, :name, :image)');
    $stmt->bindValue(':id', $ingredient->getId());
    $stmt->bindValue(':name', $ingredient->getName());
    $stmt->bindValue(':image', $ingredient->getImage());

    $stmt->execute();
  }
}
