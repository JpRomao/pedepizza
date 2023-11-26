<?php

namespace Infra\Database\Repositories;

use Application\Entities\Pizzeria;
use Application\Repositories\MenusRepository;
use Core\Entities\UniqueEntityId;
use PDO;

class MysqlMenusRepository implements MenusRepository
{
  public function __construct(private PDO $db)
  {
  }

  public function findPizzeriaByPizza(string $pizzeriaId): Pizzeria | null
  {
    $sql = "
      SELECT
        p.id,
        p.name,
        p.image,
        p.phone,
        p.cnpj,
        p.email
      FROM
        menus m
        INNER JOIN pizzerias p ON p.id = m.id_pizzeria
        WHERE m.id_pizzeria = :pizzeriaId LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':pizzeriaId', $pizzeriaId, PDO::PARAM_STR);
    $stmt->execute();

    $pizzeria = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pizzeria || empty($pizzeria)) {
      return null;
    }

    $pizzeria = Pizzeria::create(
      array(
        'name' => $pizzeria['name'],
        'image' => $pizzeria['image'],
        'phone' => $pizzeria['phone'],
        'cnpj' => $pizzeria['cnpj'],
        'email' => $pizzeria['email']
      ),
      new UniqueEntityId($pizzeria['id'])
    );

    return $pizzeria;
  }
}
