<?php

namespace Infra\Database\Repositories;

use Application\Entities\Pizza;
use Application\Repositories\PizzasRepository;
use Core\Entities\UniqueEntityId;
use PDO;

class MysqlPizzasRepository implements PizzasRepository
{
  public function __construct(private PDO $db)
  {
  }

  public function findOne(string $id): ?Pizza
  {

    $stmt = $this->db->prepare('SELECT id, name, image, created_by FROM pizzas WHERE id = :id');
    $stmt->bindValue(':id', $id);

    $stmt->execute();

    $pizza = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pizza) {
      return null;
    }

    $pizzaToCreate = $pizza;

    unset($pizzaToCreate['created_by']);
    unset($pizzaToCreate['id']);

    $ingredientsSql = 'SELECT i.id, i.name, i.image, i.created_by FROM pizzas_ingredients pi INNER JOIN ingredients i ON pi.id_ingredient = i.id WHERE pi.id_pizza = :pizzaId';

    $stmt = $this->db->prepare($ingredientsSql);


    $stmt->bindValue(':pizzaId', $id, PDO::PARAM_STR);

    $stmt->execute();

    $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pizzaToCreate['ingredients'] = $ingredients;

    $pizza = Pizza::create($pizzaToCreate, new UniqueEntityId($pizza['id']));

    return $pizza;
  }

  public function findMany(int $page): ?array
  {
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $stmt = $this->db->prepare('SELECT id, name, created_by FROM pizzas ORDER BY name LIMIT :limit OFFSET :offset');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    $pizzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$pizzas) {
      return null;
    }

    return $pizzas;
  }

  public function create(Pizza $pizza): void
  {
    $stmt = $this->db->prepare('INSERT INTO pizzas (name, image) VALUES (:name, :image)');
    $stmt->bindValue(':name', $pizza->getName());
    $stmt->bindValue(':image', $pizza->getImage());

    $stmt->execute();
  }
}
