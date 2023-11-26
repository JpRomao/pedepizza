<?php

namespace Infra\Database\Repositories;

use Application\Repositories\PizzasIngredientsRepository;
use PDO;

class MysqlPizzaIngredientsRepository implements PizzasIngredientsRepository
{
  public function __construct(private PDO $db)
  {
  }

  public function findManyByIngredients(array $ingredientsIds, int $page): array
  {
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT p.id, p.name, p.image, p.time_to_prepare, GROUP_CONCAT(i.name SEPARATOR ', ') AS ingredients
            FROM pizzas_ingredients pi
            INNER JOIN pizzas p ON p.id = pi.id_pizza
            INNER JOIN ingredients i ON i.id = pi.id_ingredient
            WHERE pi.id_ingredient IN (";

    for ($i = 0; $i < count($ingredientsIds); $i++) {
      $sql .= ":ingredient{$i},";
    }

    $sql = substr($sql, 0, -1);

    $sql .= ") GROUP BY p.id LIMIT :start, :end";

    $statement = $this->db->prepare($sql);
    $statement->bindValue(':start', $offset, PDO::PARAM_INT);
    $statement->bindValue(':end', $limit, PDO::PARAM_INT);

    for ($i = 0; $i < count($ingredientsIds); $i++) {
      $statement->bindValue(":ingredient{$i}", $ingredientsIds[$i], PDO::PARAM_STR);
    }

    $statement->execute();

    $sql = $statement->queryString;

    $pizzas = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $pizzas;
  }

  public function create(string $pizzaId, array $ingredientsId): void
  {
    $sql = "INSERT INTO pizzas_ingredients (id_pizza, id_ingredient) VALUES ";

    for ($i = 0; $i < count($ingredientsId); $i++) {
      $sql .= "(:pizzaId{$i}, :ingredient{$i}),";
    }

    $sql = substr($sql, 0, -1);

    $statement = $this->db->prepare($sql);


    for ($i = 0; $i < count($ingredientsId); $i++) {
      $statement->bindValue(':pizzaId${$i}', $pizzaId, PDO::PARAM_STR);
      $statement->bindValue(":ingredient{$i}", $ingredientsId[$i], PDO::PARAM_STR);
    }

    $statement->execute();
  }
}
