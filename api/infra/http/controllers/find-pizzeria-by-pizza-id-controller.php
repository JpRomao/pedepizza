<?php

namespace Infra\Http\Controllers;

use Application\UseCases\Errors\FieldsMissingError;
use Application\UseCases\FindPizzeriaByPizzaIdUseCase;
use Core\Response;
use Exception;
use Infra\Database\Repositories\MysqlMenusRepository;
use Infra\Database\Repositories\MysqlPizzasRepository;
use PDO;

class FindPizzeriaByPizzaIdController extends Controller
{
  public function __construct(private PDO $db)
  {
    parent::__construct($db);
  }

  public function handle()
  {
    $pizzaId = $this->request['query']['pizzaId'];

    if (empty($pizzaId) || !is_string($pizzaId)) {
      return new Response(500, null, FieldsMissingError::_getMessage());
    }

    $menusRepository = new MysqlMenusRepository($this->db);
    $pizzasRepository = new MysqlPizzasRepository($this->db);
    $findPizzeriaByPizzaIdUseCase = new FindPizzeriaByPizzaIdUseCase($menusRepository, $pizzasRepository);

    try {
      $pizzeriaAndPizza = $findPizzeriaByPizzaIdUseCase->execute($pizzaId);

      if (!$pizzeriaAndPizza || !$pizzeriaAndPizza['pizzeria'] || !$pizzeriaAndPizza['pizza'] || empty($pizzeriaAndPizza['pizzeria']) || empty($pizzeriaAndPizza['pizza'])) {
        return new Response(404, null, 'Not found');
      }

      return new Response(200, $pizzeriaAndPizza, 'Fetched successfully');
    } catch (Exception | FieldsMissingError $e) {
      if ($e instanceof FieldsMissingError) {
        return new Response($e->getErrorCode(), null, $e::_getMessage());
      }

      return new Response(500, null, 'Could not connect');
    }
  }
}
